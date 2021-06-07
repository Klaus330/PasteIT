<?php


class m0010_add_ban_column_to_users_table extends \app\core\Migration
{
    public function up()
    {
        $sql = "
            ALTER TABLE users ADD COLUMN banned BIT DEFAULT 0;       
        ";

        app('db')->getPdo()->exec($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE users DROP COLUMN banned;";
        app('db')->getPdo()->exec($sql);
    }
}