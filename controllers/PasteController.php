<?php

namespace app\controllers;

use app\core\Request;

class PasteController extends Controller
{
    public function index(){
        return view('/pastes/index');
    }

    public function store(Request $request){
        $body = $request->getBody();
    }

    public function lockedPaste(){
        return view('/pastes/locked-paste');
    }

    public function edit(){
        return view('/pastes/edit');
    }
}