<?php


use app\core\Migration;

class m0005_create_pastes_table extends Migration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS pastes(
              id INT AUTO_INCREMENT PRIMARY KEY,
              code TEXT NOT NULL,
              burn_after_read BIT,
              password VARCHAR(40),
              expiration_date DATETIME,
              slug VARCHAR(255) NOT NULL,
              title VARCHAR(255) NOT NULL,
              nr_of_views INT,
              exposure BIT,
              expired BIT DEFAULT 0,
              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
              id_syntax INT,
              FOREIGN KEY (id_syntax) REFERENCES highlights(id),
              id_user INT,
              FOREIGN KEY (id_user) REFERENCES users(id)
            ) ENGINE=INNODB;
        ";


        app('db')->getPdo()->exec($sql);


    }

    public function down()
    {
        $sql = "DROP TABLE pastes";

        app('db')->getPdo()->exec($sql);
    }
}