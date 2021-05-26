<?php


class m0008_add_column_role_to_paste_users_table extends \app\core\Migration
{

    public function up()
    {

        $sql = "
            ALTER TABLE pastes_users ADD COLUMN role VARCHAR(255) DEFAULT 'viewer';       
        ";

        app('db')->getPdo()->exec($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE pastes_users DROP COLUMN role;";
        app('db')->getPdo()->exec($sql);
    }
}