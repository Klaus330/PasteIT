<?php

namespace app\controllers;

use app\core\Request;
use app\models\Paste;

class PasteController extends Controller
{
    public function index(){
        return view('/pastes/index');
    }

    public function store(Request $request){
//        dd($request->getBody());
        $paste = new Paste();
        if($request->validate($paste->rules())){

            $body = $request->getBody();
            $paste->loadData($body);
            $slug = str_replace(" ",'-',strtolower($body['title']));
            $paste->slug = $slug;
            $paste->save();

            session()->setFlash("success", 'Your paste has been saved');
            redirect("/");
        }

        return view("home",[
            'errors' => $request->getErrors()
        ]);
    }

    public function lockedPaste(){
        return view('/pastes/locked-paste');
    }

    public function edit(){
        return view('/pastes/edit');
    }

    public function view(){
        dd($_REQUEST);
    }

}