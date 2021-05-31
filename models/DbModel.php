<?php


namespace app\models;

use app\core\Application;
use Exception;
use PDO;
use PDOException;
use ReflectionClass;

abstract class DbModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function getPrimaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $parameters = $this->parameterizeValues($attributes);

        return $this->insert($tableName, $attributes, $parameters);
    }

    /**
     * @param string $tableName
     * @param array $attributes
     * @param array $parameters
     * @return mixed
     */
    public function insert(string $tableName, array $attributes, array $parameters)
    {
        $sql = sprintf("insert into %s(%s) values(%s)",
            $tableName,
            implode(', ', $attributes),
            implode(',', $parameters)
        );

        $statement = self::prepare($sql);

        try {
            foreach ($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }

            $result = $statement->execute();

            return $result;
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    protected function saveRelationship(array $payload, string $tableName)
    {

        $attributes = array_keys($payload);
        $parameters = array_values($payload);
        $parameterizedAttributes = $this->parameterizeValues($attributes);

        $sql = sprintf("insert into %s(%s) values(%s)",
            $tableName,
            implode(', ', $attributes),
            implode(',', $parameterizedAttributes)
        );

        $statement = self::prepare($sql);

        try {
            foreach ($attributes as $key => $attribute) {
                $statement->bindValue(":$attribute", $parameters[$key]);
            }

            $result = $statement->execute();

            return $result;
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public static function prepare($sql)
    {
        return app('db')->getPdo()->prepare($sql);
    }

    private function parameterizeValues($array)
    {
        return array_map(function ($param) {
            return ":{$param}";
        }, $array);
    }


    public static function find($where = ['1' => 1], $separator = "AND", $orderBy = "")
    {
        $tableName = (new static)->tableName();
        $attributes = array_keys($where);


        $parameters = implode(
            $separator,
            array_map(fn($attribute) => " $attribute  = :$attribute ", $attributes)
        );

        $sql = "SELECT * FROM $tableName WHERE $parameters;";
        if (!empty($orderBy)) {
            $sql = "SELECT * FROM $tableName WHERE $parameters ORDER BY $orderBy[0] $orderBy[1];";
        }

        $statement = self::prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        try {
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }


    public static function latest(int $limit = 15, mixed $where = [], string $separator = "AND")
    {
        $tableName = (new static)->tableName();
        if ($where !== []) {
            $attributes = array_keys($where);

            $parameters = implode(
                $separator,
                array_map(fn($attribute) => " $attribute  = :$attribute ", $attributes)
            );

            $sql = "SELECT * FROM $tableName WHERE $parameters  ORDER BY created_at DESC LIMIT $limit;";
        } else {
            $sql = "SELECT * FROM $tableName ORDER BY created_at DESC LIMIT $limit;";
        }

        $statement = self::prepare($sql);
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        try {
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS, static::class);
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }


    public static function findOne($where)
    {
        $tableName = (new static)->tableName();
        $attributes = array_keys($where);

        $parameters = implode(
            "AND",
            array_map(fn($attribute) => " $attribute  = :$attribute ", $attributes)
        );
        $sql = "SELECT * FROM $tableName WHERE $parameters";

        $statement = self::prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        try {
            $statement->execute();
            return $statement->fetchObject(static::class);
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public static function update(array $data, array $where, string $separator = "AND")
    {
        $tableName = (new static)->tableName();
        $attributes = array_keys($where);
        $colums = array_keys($data);

        $values = implode(",",
            array_map(fn($key) => "$key=:$key", $colums)
        );

        $parameters = implode(
            $separator,
            array_map(fn($attribute) => " $attribute=:$attribute ", $attributes)
        );

        $sql = "UPDATE $tableName SET $values WHERE $parameters";

        $statement = self::prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        try {
            $statement->execute();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return false;
    }


    public function edit(array $data)
    {
        $tableName = $this->tableName();
        $colums = array_keys($data);

        $values = implode(",",
            array_map(fn($key) => " $key=:$key ", $colums)
        );


        $primaryKey = $this->getPrimaryKey();
        $primaryKeyValue = $this->{$primaryKey};
        $sql = "UPDATE $tableName SET $values WHERE $primaryKey=$primaryKeyValue; ";

        $statement = self::prepare($sql);

        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        try {
            $statement->execute();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return false;
    }

    public static function delete(array $where, string $separator = 'AND'): bool
    {

        $tableName = (new static)->tableName();
        $attributes = array_keys($where);

        $parameters = implode(
            $separator,
            array_map(fn($attribute) => "$attribute=:$attribute", $attributes)
        );

        $sql = "DELETE FROM $tableName WHERE $parameters";

        $statement = self::prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        try {
            $statement->execute();
            return true;
        } catch (Exception $e) {
            $e->getMessage();
        }
        return false;
    }

    public function destroy(): bool
    {

        $tableName = $this->tableName();

        $sql = "DELETE FROM $tableName WHERE id=:id";

        $statement = self::prepare($sql);

        $statement->bindValue(":id", $this->id);

        try {
            $statement->execute();
            return true;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
        return false;
    }


    public static function create($data): static
    {
        $instace = new static;

        $instace->loadData($data);

        return $instace;
    }


    public function belongsTo($column, $class)
    {
        return $class::findOne([$class::getPrimaryKey() => $this->{$column}]);
    }


    public function hasOne($column, $class)
    {
        return $class::findOne([$column => $this->id]);
    }


    public function hasMany($class, $relationTableName, $where = [], $separator = "AND"): array
    {
        try {
            $searchedClass = new ReflectionClass($class);

            $searchedClassName = strtolower((new ReflectionClass($class))->getShortName());
            $currentClassName = strtolower((new ReflectionClass($this))->getShortName());


            $whereCondition = implode($separator,
                array_map(fn($key) => " $key=:$key ", array_keys($where))
            );

            if (!empty($where)) {
                $sql = "SELECT id_$searchedClassName  FROM $relationTableName WHERE id_$currentClassName=:$currentClassName AND $whereCondition;";
                $statement = self::prepare($sql);

                foreach ($where as $key => $value) {
                    $statement->bindValue(":$key", $value);
                }
            } else {
                $sql = "SELECT id_$searchedClassName  FROM $relationTableName WHERE id_$currentClassName=:$currentClassName;";
                $statement = self::prepare($sql);
            }

            $statement->bindValue(":$currentClassName", $this->id);


            $statement->execute();

            $listOfObjects = [];
            $results = $statement->fetchAll(PDO::FETCH_COLUMN);
            foreach ($results as $id) {
                $searchedTableName = $searchedClass->getMethod("tableName")->invoke(new $class());
                $searchedClassPrimaryKey = $searchedClass->getMethod("getPrimaryKey")->invoke(null);
                $query = "SELECT * FROM $searchedTableName WHERE $searchedClassPrimaryKey=:$searchedClassPrimaryKey";

                $newStatement = self::prepare($query);

                $newStatement->bindValue(":$searchedClassPrimaryKey", $id);

                $newStatement->execute();

                $listOfObjects[] = $newStatement->fetchObject($class);
            }

            return $listOfObjects;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function belongsToMany($class, $orderBy)
    {
        try {
            $searchedClass = new ReflectionClass($class);
            $currentClassName = strtolower((new ReflectionClass($this))->getShortName());
            $searchedTableName = $searchedClass->getMethod("tableName")->invoke(new $class());

            $sql = "SELECT * FROM $searchedTableName WHERE id_$currentClassName=:$currentClassName";

            if (!empty($orderBy)) {
                $order = $orderBy[1] ?? '';
                $sql = $sql . " ORDER BY $orderBy[0] $order";
            }

            $statement = self::prepare($sql);
            $statement->bindValue(":$currentClassName", $this->id);

            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_CLASS, $class);

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function checkIfUnique($attribute, $value)
    {
        $tableName = $this->tableName();


        $sql = "SELECT * FROM $tableName WHERE $attribute=:$attribute";

        $statement = app('db')->prepare($sql);
        $statement->bindValue(":$attribute", $value);
        $statement->execute();
        $record = $statement->fetchObject();

        return ($record == null);
    }


    public static function paginate($pageNr, $nrOfRecords, $where = [], $separator = "AND")
    {
        try {
            $tableName = (new static)->tableName();
            $lastPageNr = ($pageNr - 1) * $nrOfRecords;

            $whereCondition = implode($separator,
                array_map(fn($key) => " $key=:$key ", array_keys($where))
            );


            if (empty($where)) {
                $sql = "SELECT * FROM $tableName LIMIT $lastPageNr, $pageNr";
                $statement = self::prepare($sql);
            } else {
                $sql = "SELECT * FROM $tableName WHERE $whereCondition LIMIT $lastPageNr, $nrOfRecords";
                $statement = self::prepare($sql);

                foreach ($where as $key => $value) {
                    $statement->bindValue(":$key", $value);
                }
            }

            $statement->execute();
            return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function load($dataToLoad) // ['editors', 'syntax', 'user']
    {
          foreach($dataToLoad as $method)
          {
            $this->$method = $this->$method();
          }
    }
}