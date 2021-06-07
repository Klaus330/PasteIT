<?php


use app\models\Settings;
use app\models\User;

class UserSeeder implements \app\core\Seeder
{

    public function run()
    {
        $user = new User();
        $user->username="admin";
        $user->email="admin@paste.it";
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



        $user = new User();
        $user->username="guest";
        $user->email="guest@paste.it";
        $user->password="guest";
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