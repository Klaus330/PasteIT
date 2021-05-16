<?php

namespace app\controllers;

use app\core\Application;
use app\models\Paste;
use app\models\Syntax;
use DateTime;


class HomeController extends Controller
{
    public function index()
    {

        $captchaCode = "";
        if (app()::isGuest()) {
            $captchaCode = CaptchaController::genCaptcha();
        }


        $syntaxes = Syntax::find();
        $latestPastes = Paste::latest(5, ["expired" => 0]);

        return view('home',
            [
                'captchaCode' => $captchaCode,
                'syntaxes' => $syntaxes,
                'latestPastes' => $latestPastes
            ]);
    }
}