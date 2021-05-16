<?php

namespace app\controllers;

use app\core\exceptions\AccessDeniedException;
use app\core\exceptions\PageNotFoundException;
use app\core\Random;
use app\core\routing\Request;
use app\core\Validator;
use app\models\Paste;
use app\models\Syntax;
use app\models\User;

class PasteController extends Controller
{
    public function index()
    {
        return view('/pastes/index');
    }

    public function store(Request $request)
    {
        \unlink(session()->getFlash("captcha_path"));
        if (app()::isGuest() && session()->getFlash('captcha_code') != $request->getBody()['captcha_code']) {
            return redirect("/");
        }

        $paste = new Paste();
        if ($request->validate($paste->rules())) {

            $body = $request->getBody();
            $paste->loadData($body);
            $slug = Random::generate();
            $paste->slug = $slug;

            $paste->save();

            session()->setFlash("success", 'Your paste has been saved');
            redirect("/paste/view/$slug");
        }

        redirect("/");
    }

    public function lockedPaste(Request $request)
    {
        $slug = $request->getParamForRoute('/pastes/locked-paste/');
        $paste = Paste::findOne(['slug' => $slug]);

        return view('/pastes/locked-paste', compact('paste'));
    }

    public function unlockPaste(Request $request)
    {
        $slug = $request->getBody()['slug'];
        $password = $request->getBody()['password'];
        session()->setFlash($slug, $password);
        redirect("/paste/view/$slug");
    }


    public function edit(Request $request)
    {
        $slug = $request->getParamForRoute('/pastes/edit/');
        $paste = Paste::findOne(['slug' => $slug]);
        $syntaxes = Syntax::find();
        return view('/pastes/edit', compact("paste","syntaxes"));
    }

    public function validateBurnAfterRead(Request $request)
    {
        $slug = $request->getBody()['slug'];
        session()->setFlash("$slug-burn", 1);
        redirect("/paste/view/$slug");
    }

    public function show(Request $request)
    {

        $slug = $request->getParamForRoute('/paste/view/');

        $paste = Paste::findOne(['slug' => $slug]);

        $this->canShowPaste($paste);

        if (!$paste->hasPassword() || $paste->matchPassword(session()->getFlash($slug))) {
            $latestPastes = Paste::latest(5, ["expired" => 0, "exposure" => 0]);

            return view('/pastes/index', compact("paste", 'latestPastes'));
        }

        return redirect("/pastes/locked-paste/$slug")->withErrors(['password' => "Password doesn't match"]);
    }

    private function canShowPaste($paste){

        if($paste == false){
            throw new PageNotFoundException();
        }
        $slug = $paste->slug;
        if($paste->isPrivate()){
            if(!session()->has('user')){
                throw new AccessDeniedException();
            }

            if(!$paste->isOwner(session()->get('user'))){
                throw new AccessDeniedException();
            }
        }

        if($paste->expired()){
            $paste->edit(['expired'=>1]);
            throw new PageNotFoundException();
        }

        if ($paste->isBurnAfterRead()) {

            if (!session()->hasFlash("$slug-burn")) {
                redirect("/pastes/burn-after-read/$slug");
                return;
            }
            $paste->destroy();
        }

        if ($paste->hasPassword()
            && !session()->hasFlash($slug)
        ) {
            redirect("/pastes/locked-paste/$slug");
        }
    }



    public function burnAfterRead(Request $request)
    {
        $slug = $request->getParamForRoute('/pastes/burn-after-read/');
        return view('/pastes/burn-after-read', compact('slug'));
    }

    public function delete(Request $request)
    {
        $slug = $request->getParamForRoute('/paste/delete/');
        $paste = Paste::findOne(['slug' => $slug]);

        if ($paste == null) {
            session()->setFlash("danger", "Nu a fost gasita nicio postare.");
            return redirect("/");
        }
        $paste->destroy();
        session()->setFlash("succes", "Postarea a fost stearsa.");
        return redirect('/');
    }

    public function update(Request $request)
    {

        $slug = $request->getParamForRoute('/pastes/update/');
        $paste = Paste::findOne(['slug' => $slug]);

        if ($request->validate([
            "code" => [Validator::RULE_REQUIRED],
            "title" => [Validator::RULE_REQUIRED]
        ])) {

            $body = $request->getBody();
            $paste->edit($body);
            session()->setFlash("succes", "Postarea a fost actualizata");
            return redirect("/paste/view/$slug");
        }
        return redirect("/paste/edit/$slug")->withErrors($request->getErrors());
    }
}