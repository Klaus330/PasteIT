<?php

namespace app\controllers;

use app\core\Application;
use app\models\Syntax;


class HomeController extends Controller
{
    public function index()
    {
        $captchaCode = "";
        if (app()::isGuest()) {
            $captchaCode = CaptchaController::getCaptcha();
        }
        $syntaxes = Syntax::find();
        return view('home',
            [
                'captchaCode' => $captchaCode,
                'syntaxes' => $syntaxes
            ]);
    }
}