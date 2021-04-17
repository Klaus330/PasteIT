<?php


namespace app\core\database;


use app\core\Application;

class Database
{

    protected \PDO $pdo;
    protected $config;
    protected static $connection;


    public static function getConnection(){
        if(empty(self::$connection)){
            self::$connection = new Database();
        }

        return self::$connection;
    }

    /**
     * Database constructor.
     */
    protected function __construct()
    {
        $this->config = Application::$config['database'];
        $this->pdo = Connection::make($this->config);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        $newMigrations = [];
        foreach ($toApplyMigrations as $migration){
            if($migration === "." || $migration === ".." )
            {
                continue;
            }

            require_once Application::$ROOT_DIR."/migrations/$migration";
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();

            $this->log("Applying migration $migration");
            $instance->up();
            $newMigrations[] = $migration;
            $this->log( "Migration $migration applied");
        }

        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }else{
            $this->log( "All migrations are applied");;
        }

    }


    public function downMigrations(){
        $appliedMigrations = $this->getAppliedMigrations();

        foreach ($appliedMigrations as $migration){
            require_once Application::$ROOT_DIR."/migrations/$migration";
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Deleting migration $migration");
            $instance->down();
            $this->removeMigrationRecord($migration);
            $this->log( "Migration $migration deleted");
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS migrations(
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
    
            ) ENGINE=INNODB;"
        );
    }


    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    private function saveMigrations(array $newMigrations)
    {
        $migrations = implode(",",array_map(fn($migration) => "('$migration')", $newMigrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations(migration) VALUES {$migrations}");
        $statement->execute();
    }

    protected function log($message){
        echo '['.date('Y-m-d H:i:s').']: '. $message.PHP_EOL;
    }

    /**
     * @return \PDO
     */
    public function getPdo(): \PDO
    {
        return $this->pdo;
    }

    private function removeMigrationRecord(string $migration)
    {
        $statement = $this->pdo->prepare("DELETE FROM migrations WHERE migration='{$migration}'");
        $statement->execute();
    }
}