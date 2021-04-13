<?php


namespace app\core\database;


use app\core\Application;

class Connection
{
    public static function make(){
        $config = Application::$config['database'];
        return new \PDO(
            $config['DB_CONNECTION'].";dbname={$config['DB_NAME']}",
            $config['DB_USER'],
            $config['DB_PASS'],
            $config['DB_OPTIONS']
        );
    }
}