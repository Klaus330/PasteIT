<?php

use app\core\Migration;

class m0002_create_contact_table extends Migration {


    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS contact(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(55) NOT NULL,
                email VARCHAR(55) NOT NULL,
                message TEXT
            ) ENGINE=INNODB;
        ";

        app('db')->getPdo()->exec($sql);
    }


    public function down()
    {
        $sql = "DROP TABLE contact;";

        app('db')->getPdo()->exec($sql);
    }
}