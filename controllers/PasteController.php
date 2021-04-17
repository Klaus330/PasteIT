<?php

namespace app\controllers;

use app\core\Request;

class PasteController extends Controller
{
    public function index(){
        return $this->render('/pastes/index');
    }

    public function store(Request $request){
        $body = $request->getBody();
    }

    public function lockedPaste(){
        return $this->render('/pastes/locked-paste');
    }

    public function edit(){
        return $this->render('/pastes/edit');
    }
}