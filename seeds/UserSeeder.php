<?php


use app\models\Settings;
use app\models\User;

class UserSeeder implements \app\core\Seeder
{

    public function run()
    {
        $user = new User();
        $user->username="guest";
        $user->email="admin@admin.com";
        $user->password="admin";
        $user->save();

        $settings = Settings::create(
            [
                'id_user' => User::findOne(['email' => $user->email])->id,
                'id_syntax' => 1,
                'exposure' => 0,
                'expiration' => ''
            ]
        );

        $settings->save();
    }
}