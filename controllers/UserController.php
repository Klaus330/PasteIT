<?php

namespace app\controllers;

use app\core\Request;
use app\core\Validator;
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
        $settings = Settings::findOne(['id_user' => $userId]);
        return view('/user/settings', compact(["userId", "errors", 'settings']));
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

    public function destroy()
    {
//        $userId = session()->get("user");
//        User::delete(["id"=>$userId]);
        auth()->destroy();
        app()->logout();
        redirect("/");
    }

    public function profileUpdate(Request $request)
    {
        $body = $request->getBody();
        $rules = [
            "username" => [Validator::RULE_REQUIRED],
            "email" => [Validator::RULE_REQUIRED, Validator::RULE_EMAIL]
        ];


        if ($request->validate($rules)) {
            auth()->username = $request->getBody()["username"];
            auth()->email = $request->getBody()["email"];

            if (isset($_FILES["avatar"])) {

                $fileName = $_FILES["avatar"]["name"];
                $tmpName = $_FILES["avatar"]["tmp_name"];
                $fileSize = $_FILES["avatar"]["size"];
                $fileError = $_FILES["avatar"]["error"];
                $fileType = $_FILES["avatar"]["type"];
                $fileExtension = explode(".",$fileName)[1];
                $allowedExtensions =["png","jpg","jpeg"];

                if(in_array($fileExtension,$allowedExtensions))
                {
                    $fileName = $body["username"];
                    $filePathDestination = "/storage/images/avatars/".$fileName.".$fileExtension";

                    if(auth()->avatar){
                        $absoluteFileCurrentPath = app()::$ROOT_DIR.'/public'.auth()->avatar;
                        unlink($absoluteFileCurrentPath);
                    }

                    $absoluteFilePath = app()::$ROOT_DIR.'/public'.$filePathDestination;
                    move_uploaded_file($tmpName,$absoluteFilePath);

                    $body["avatar"] = $filePathDestination;
                    auth()->avatar =  $body["avatar"];
                }
            }
            
            auth()->update($body, ["id" => auth()->id]);
            redirect("/user/profile");
        }

        return view("/user/profile",["errors"=>$request->getErrors()]);

    }

}