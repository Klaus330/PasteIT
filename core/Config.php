<?php


namespace app\core;


use PDO;

class Config
{
    protected $configuration = [
        'app_title' => 'Paste It',
        'user_class' => \app\models\User::class,
        'database' => [
            'DB_NAME' => "web",
            'DB_USER' => 'root',
            'DB_PASS' => '',
            'DB_CONNECTION' => 'mysql:host=127.0.0.1',
            'DB_OPTIONS' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        ]
    ];


    public function get($key)
    {
        return $this->configuration[$key];
    }

    public function set($key, $value)
    {
        $this->configuration[$key] = $value;
        return $this;
    }
}