<?php

namespace App\Controllers;

use App\Core\Application;

class ContactController
{
    public static function index(){
        $params = [
            'name' => 'Claudiu'
        ];

        return Application::$app->router->renderView('contact', $params);
    }
}