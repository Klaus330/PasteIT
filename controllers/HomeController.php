<?php

namespace app\controllers;

use app\core\Application;


class HomeController extends Controller
{
    public function index()
    {
        $captchaCode = CaptchaController::getCaptcha();

        return $this->renderWithPartial(
            "{{login-alert}}", "/alerts/guestalert", 'home',
            ['captchaCode' => $captchaCode]
        );
    }
}