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
        $user->avatar = 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png';
        $user->save();

        $settings = Settings::create(
            [
                'id_user' => User::findOne(['email' => $user->email])->id,
                'id_syntax' => 1,
                'exposure' => '',
                'expiration' => ''
            ]
        );

        $settings->save();
    }
}