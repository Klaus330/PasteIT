<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;

class ContactController extends Controller
{
    public function index(){
        $params = [
            'name' => 'Claudiu'
        ];

        return $this->render('contact', $params);
    }
}