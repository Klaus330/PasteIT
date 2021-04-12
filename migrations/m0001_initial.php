<?php

use app\core\Migration;

class m0001_initial extends Migration {


    public function up()
    {
        $db = \app\core\Application::$app->db;

        $sql = "
            CREATE TABLE IF NOT EXISTS users(
              id INT AUTO_INCREMENT PRIMARY KEY,
              username VARCHAR(255),
              email VARCHAR(255) NOT NULL,
              password VARCHAR(255) NOT NULL
            ) ENGINE=INNODB;
        ";

        $db->pdo->exec($sql);
    }


    public function down()
    {
        $db = \app\core\Application::$app->db;

        $sql = "DROP TABLE users";

        $db->pdo->exec($sql);
    }
}