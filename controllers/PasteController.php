<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class PasteController extends Controller
{
    public function index(){
        return $this->render('/pastes/index');
    }

    public function store(Request $request){
        $body = $request->getBody();
    }
}