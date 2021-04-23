<?php


class m0006_create_pastes_users_relationship extends \app\core\Migration
{

    public function up()
    {
        $sql="
        CREATE TABLE IF NOT EXISTS pastes_users(
            id_paste INT,
            id_user INT,
            FOREIGN KEY (id_user) REFERENCES users(id),
            FOREIGN KEY (id_paste) REFERENCES pastes(id)
        ) ENGINE=INNODB;
        ";
        app('db')->getPdo()->exec($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE pastes_users";

        app('db')->getPdo()->exec($sql);
    }
}