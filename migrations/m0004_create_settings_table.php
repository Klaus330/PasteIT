<?php

use app\core\Migration;

class m0004_create_settings_table extends Migration
{

    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS settings(
              id INT AUTO_INCREMENT PRIMARY KEY,
              id_user INT,
              id_syntax INT,
              exposure BIT,
              expiration TIMESTAMP,
              FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE,
              FOREIGN KEY (id_syntax) REFERENCES highlights(id) ON DELETE CASCADE
            ) ENGINE=INNODB;
        ";

        app('db')->getPdo()->exec($sql);
    }

    public function down()
    {
        $sql = "DROP TABLE settings";

        app('db')->getPdo()->exec($sql);
    }
}
