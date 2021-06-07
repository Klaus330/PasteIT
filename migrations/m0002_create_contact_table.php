<?php

use app\core\Migration;

class m0002_create_contact_table extends Migration {


    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS contact(
                id INT AUTO_INCREMENT PRIMARY KEY,
                fromUsername VARCHAR(255) NOT NULL,
                fromEmail VARCHAR(255) NOT NULL,
                toUsername VARCHAR(255) NOT NULL,
                toPaste VARCHAR(55) NOT NULL,
                message TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
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