<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

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