<?php


namespace app\controllers;


use app\core\routing\Request;
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