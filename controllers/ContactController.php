<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class ContactController extends Controller
{
    public function index(){
        $params = [
            'name' => 'Claudiu'
        ];

        return $this->render('contact', $params);
    }

    public function store(Request $request){
        $body = $request->getBody();
    }
}