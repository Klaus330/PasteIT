<?php

namespace app\controllers;

use app\core\Request;
use app\middlewares\AuthMiddleware;
use app\models\Settings;

class UserController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware());
    }

    public function settings()
    {
        $userId = session()->get("user");
        $errors = [];
        $settings = Settings::findOne(['id_user'=>$userId]);
        return view('/user/settings', compact(["userId", "errors",'settings']));
    }

    public function storeSettings(Request $request)
    {
        $body = $request->getBody();
        $settings = new Settings();
        if ($request->validate($settings->rules())) {
            $settings->loadData($body);

            $settings->update($body, ['id_user' => session()->get('user')]);

            redirect("/user/profile");
        }
        return view("/user/settings", [
            'userId' => session()->get("user"),
            'errors' => $request->getErrors()
        ]);

    }

    public function profile()
    {
        $isInputChecked = false;
        if (array_key_exists('theme', $_COOKIE)) {
            $isInputChecked = $_COOKIE['theme'] === 'dark';
        }

        return view('/user/profile', ['isInputChecked' => $isInputChecked]);
    }

    public function myPastes()
    {
        return view('/user/mypastes');
    }

    public function destroy(){
//        $userId = session()->get("user");
//        User::delete(["id"=>$userId]);
        auth()->destroy();
        app()->logout();
        redirect("/");
    }

}