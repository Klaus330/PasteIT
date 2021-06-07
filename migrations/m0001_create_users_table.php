<?php

use app\core\Migration;

class m0001_create_users_table extends Migration {


    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS users(
              id INT AUTO_INCREMENT PRIMARY KEY,
              username VARCHAR(255),
              email VARCHAR(255) NOT NULL UNIQUE,
              password VARCHAR(255) NOT NULL,
              avatar VARCHAR(255)
            ) ENGINE=INNODB;
        ";

        app('db')->getPdo()->exec($sql);
    }


    public function down()
    {
        $sql = "DROP TABLE users";

        app('db')->getPdo()->exec($sql);
    }
}