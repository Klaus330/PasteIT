<?php


class m0009_add_column_is_admin_to_user_paste extends \app\core\Migration
{

    public function up()
    {
        $sql = "
            ALTER TABLE users ADD COLUMN isAdmin BIT DEFAULT 0;       
        ";

        app('db')->getPdo()->exec($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE users DROP COLUMN isAdmin;";
        app('db')->getPdo()->exec($sql);
    }
}