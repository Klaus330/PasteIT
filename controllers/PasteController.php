<?php

namespace app\controllers;

use app\core\routing\Request;
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
            dd(sha1(rand()));

                dd('hit');
            $paste->slug = $slug;
            $paste->id_user = 1;
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

    public function show(Request $request)
    {

        $slug = $request->getParam('slug');
        $paste = Paste::find(['slug'=> $slug]);
//        dd($paste);
        return view('/pastes/index');
    }
}