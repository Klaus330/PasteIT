<?php


class m0007_create_code_versions_table extends \app\core\Migration
{

    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS code_versions(
                id INT PRIMARY KEY AUTOINCREMENT,
                id_paste INT,
                FOREIGN KEY (id_paste) REFERENCES pastes(id) ON DELETE CASCADE,
                id_user INT,
                FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
                code TEXT NOT NULL,
                slug VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        ";
        app('db')->getPdo()->exec($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE code_versions";

        app('db')->getPdo()->exec($sql);
    }
}