<?php


namespace app\controllers;


use app\core\exceptions\PageNotFoundException;
use app\core\Random;
use app\core\routing\Request;
use app\core\Validator;
use app\models\Paste;
use app\models\Version;
use DateTime;

class VersionsController extends Controller
{

    public function index(Request $request)
    {
        $slug = $request->getParamForRoute("/paste/versions/");
        $paste = Paste::findOne(['slug'=>$slug]);
        if($paste === false){
            return redirect("/");
        }
        $versions = Version::find(['id_paste' => $paste->id],'AND', ['updated_at', 'DESC']);

        return view("versions/index", compact(["paste", "versions"]));
    }


    public function addVersion (Request $request)
    {
        $slug = $request->getParamForRoute("/paste/add-version/");
        $paste = Paste::findOne(['slug'=>$slug]);
        if($paste === false){
            throw  new PageNotFoundException();
        }
        $latestVersion = $paste->versions(['updated_at', 'DESC'])[0] ?? null;
        return view("versions/add", compact(["paste", "latestVersion"]));
    }


    public function store(Request $request)
    {
        $slug = $request->getParamForRoute('/paste/add-version/');
        if($request->validate([
            'code' => [Validator::RULE_REQUIRED],
            'id_paste' => [Validator::RULE_REQUIRED],
            'id_user' => [Validator::RULE_REQUIRED]
        ])){
            $body = $request->getBody();
            $version = Version::create([
                "id_user" => $body['id_user'],
                'id_paste' => $body['id_paste'],
                "code" => $body['code'],
                'slug' => Random::generate()
            ]);
            $version->save();
            session()->setFlash("succes", "Postarea a fost actualizata");

            return redirect("/paste/view/$slug");
        }
        return redirect("/paste/add-version/$slug")->withErrors($request->getErrors());
    }


    public function version(Request $request)
    {
        $slug = $request->getParamForRoute("/paste/version/");
        $version = Version::findOne(['slug'=>$slug]);
        $paste = Paste::findOne(['id'=> $version->id_paste]);
        if($version === false || $paste === false){
            return redirect("/");
        }

        return view("versions/show", compact(["version", "paste"]));
    }


    public function destroy(Request $request)
    {
        $slug = $request->getParamForRoute("/versions/delete/");
        $version = Version::findOne(['slug'=>$slug]);
        $paste = Paste::findOne(['id'=> $version->id_paste]);
        if($version === false || $paste === false){
            return redirect("/")->withErrors(["error"=>"No version or paste found"]);
        }
        $version->destroy();


        session()->setFlash("success", "Version Deleted");
        return redirect("/paste/versions/$paste->slug");
    }


    public function promote(Request $request)
    {
        $slug = $request->getParamForRoute("/versions/promote/");
        $version = Version::findOne(['slug'=>$slug]);
        $paste = Paste::findOne(['id'=> $version->id_paste]);
        if($version === false || $paste === false)
        {
            session()->setFlash("danger","No version or paste found" );
            return redirect("/");
        }
        $version->edit(['updated_at' => date('Y-m-d H:i:s') ]);


        session()->setFlash("success", "Version Promoted");
        return redirect("/paste/versions/$paste->slug");
    }

}