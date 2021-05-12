<?php

namespace app\controllers;

use app\core\routing\Request;
use app\core\Validator;
use app\middlewares\AuthMiddleware;
use app\models\Paste;
use app\models\Settings;
use app\models\Syntax;

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
        $settings = auth()->settings();
        $latestPastes = Paste::latest(5);
        $syntaxes = Syntax::find();

//        dd($settings);
        return view('/user/settings', compact(["userId", "errors", 'settings', 'latestPastes', 'syntaxes']));
    }

    public function storeSettings(Request $request)
    {
        $body = $request->getBody();
        $settings = new Settings();
        if ($request->validate($settings->rules())) {
            $settings->loadData($body);

            $settings->update($body, ['id_user' => auth()->id]);

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
        $latestPastes = Paste::latest(5);
        return view('/user/profile', compact('isInputChecked', 'latestPastes'));
    }

    public function myPastes()
    {

        $userPastes=Paste::latest(5,["id_user"=>auth()->id]);
        return view('/user/mypastes',compact('userPastes'));
    }

    public function destroy()
    {
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