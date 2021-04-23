<?php

namespace app\controllers;

use app\core\Request;
use app\models\Paste;
use app\models\User;

class PasteController extends Controller
{
    public function index()
    {
        return view('/pastes/index');
    }

    public function store(Request $request)
    {
        if (app()::isGuest() && session()->get('captcha_code') != $request->getBody()['captcha_code']) {
            redirect("/");
        }

        $paste = new Paste();
        if ($request->validate($paste->rules())) {

            $body = $request->getBody();
            $paste->loadData($body);
            $slug = str_replace(" ", '-', strtolower($body['title']));
            $paste->slug = $slug;
            $paste->save();

            session()->setFlash("success", 'Your paste has been saved');
            redirect("/");
        }

        redirect("/");
    }

    public function lockedPaste()
    {
        return view('/pastes/locked-paste');
    }

    public function edit()
    {
        return view('/pastes/edit');
    }

    public function view()
    {

        Paste::find();

        dd($_REQUEST);
    }

}