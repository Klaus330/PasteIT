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
use app\models\Version;

class PasteController extends Controller
{
    public function index()
    {
        return view('/pastes/index');
    }

    public function store(Request $request)
    {
        if (app()::isGuest() && session()->getFlash('captcha_code') != $request->getBody()['captcha_code']) {
            return redirect("/")->withErrors(['captcha'=>'You must complete the captcha first']);
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

        return redirect("/")->withErrors($request->getErrors());
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
        $latestVersion = $paste->versions(['updated_at', 'DESC'])[0] ?? null;
        return view('/pastes/edit', compact("paste", "syntaxes", "latestVersion"));
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

        if ((session()->has("user") && $paste->isOwner(auth()->id)) || !$paste->hasPassword() || $paste->matchPassword(session()->getFlash($slug))) {
            $latestPastes = Paste::latest(5, ["expired" => 0, "exposure" => 0]);

            $latestVersion = $paste->versions(['updated_at', 'DESC'])[0] ?? null;


            return view('/pastes/index', compact("paste", 'latestPastes', 'latestVersion'));
        }

        return redirect("/pastes/locked-paste/$slug")->withErrors(['password' => "Password doesn't match"]);
    }

    private function canShowPaste($paste)
    {

        if ($paste == false) {
            throw new PageNotFoundException();
        }

        if ($paste->expired()) {
            if((session()->has("user") && $paste->isOwner(auth()->id))){
                return;
            }
            
            $paste->edit(['expired' => 1]);
            throw new PageNotFoundException();
        }

        if(
            (session()->has("user") && ($paste->isOwner(auth()->id) || $paste->canView(auth()->id)))
        ){
            return;
        }

        $slug = $paste->slug;
        if ($paste->isPrivate()) {
            if (!session()->has('user')) {
                throw new AccessDeniedException();
            }

            if (!$paste->isOwner(session()->get('user'))) {
                throw new AccessDeniedException();
            }
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
            'id_user' => [Validator::RULE_REQUIRED],
            'id_paste' => [Validator::RULE_REQUIRED],
            "code" => [Validator::RULE_REQUIRED],
            "title" => [Validator::RULE_REQUIRED]
        ])) {

            $body = $request->getBody();
            $password = $body["password"] == "" ? "" : sha1($body["password"]);

            $pastePayload = [
                "exposure" => $body["exposure"],
                "id_syntax" => $body["id_syntax"],
                "burn_after_read" => $body["burn"] ?? "",
                "password" => $password,
                "title" => $body["title"]
            ];


            if(!empty($body['expiration_date']))
            {
                $pastePayload["expiration_date"]= $body['expiration_date'];
            }

            $paste->edit($pastePayload);
            $latestVersion = $paste->versions(['updated_at', 'DESC'])[0] ?? null;
            $body['code'] = htmlspecialchars($body['code']);
            if (($latestVersion != null && $latestVersion->code != $body["code"]) || ($latestVersion == null && $paste->code != $body['code'])) {
                $version = Version::create([
                        "id_user" => $body['id_user'],
                        'id_paste' => $body['id_paste'],
                        "code" => $body['code'],
                        'slug' => Random::generate()
                ]);
                $version->save();
            }

            session()->setFlash("succes", "Postarea a fost actualizata");

            return redirect("/paste/view/$slug");
        }
        return redirect("/paste/edit/$slug")->withErrors($request->getErrors());
    }


    public function updateViews(Request $request)
    {
        header("Access-Contorl-Allow-Origin:*");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

        $slug = $request->getParamForRoute("/pastes/update-views/");

        $paste = Paste::findOne(['slug' => $slug]);

        $viewsNumber = $paste->nr_of_views + 1;

        $paste->edit(['nr_of_views' => $viewsNumber]);

        return json_encode(['views' => $viewsNumber]);
    }


    public function addEditor(Request $request)
    {

        header("Access-Contorl-Allow-Origin:*");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

        $id_paste = $request->getParamForRoute('/paste/add-editor/');
        $paste = Paste::findOne(['id' => $id_paste]);

        if ($request->validate([
            'username' => [Validator::RULE_REQUIRED],
            'role' => [Validator::RULE_REQUIRED],
        ])) {

            $username = $request->getBody()["username"];
            $role = $request->getBody()["role"];

            $user = User::findOne(['username' => $username]);
            if($user === false){
                response()->setStatusCode(500);
                return json_encode(["errors"=>["username"=>"User not found"]]);
            }
            $paste->addEditor($user->id, $role);

            return json_encode(["message"=>"Editor adaugat cu success"]);
        }
        response()->setStatusCode(500);
        return json_encode(["errors"=>$request->getErrors()]);
    }


    public function getRawData(Request $request)
    {
        $slug = $request->getParamForRoute("/paste/raw/");

        $paste = Paste::findOne(['slug' => $slug]);
        $latestVersion = $paste->versions(['updated_at', 'DESC'])[0] ?? null;

        echo "<pre>";
        echo $latestVersion->code ?? $paste->code;
        echo "</pre>";

        return;
    }


}