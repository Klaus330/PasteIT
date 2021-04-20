<?php

use app\core\Migration;

class m0003_create_highlights_table extends Migration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS highlights(
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(55) NOT NULL
            ) ENGINE=INNODB;
        ";

        app('db')->getPdo()->exec($sql);
    }


    public function down()
    {
        $sql = "DROP TABLE highlights;";

        app('db')->getPdo()->exec($sql);
    }

}