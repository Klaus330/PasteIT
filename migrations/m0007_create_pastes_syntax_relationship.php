<?php


class m0007_create_pastes_syntax_relationship extends \app\core\Migration
{
    public function up()
    {
        $sql="
        CREATE TABLE IF NOT EXISTS pastes_highlights(
            id_paste INT,
            id_syntax INT,
            FOREIGN KEY (id_syntax) REFERENCES highlights(id),
            FOREIGN KEY (id_paste) REFERENCES pastes(id)
        ) ENGINE=INNODB;
        ";
        app('db')->getPdo()->exec($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE pastes_highlights";

        app('db')->getPdo()->exec($sql);
    }
}