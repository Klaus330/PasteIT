<?php

use app\core\Migration;

class m0002_create_contact_table extends Migration {


    public function up()
    {
        $db = \app\core\Application::$app->db;

        $sql = "
            CREATE TABLE IF NOT EXISTS contact(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(55) NOT NULL,
                email VARCHAR(55) NOT NULL,
                message TEXT
            ) ENGINE=INNODB;
        ";

        $db->getPdo()->exec($sql);
    }


    public function down()
    {
        $db = \app\core\Application::$app->db;

        $sql = "DROP TABLE contact";

        $db->getPdo()->exec($sql);
    }
}