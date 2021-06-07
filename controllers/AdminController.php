<?php


namespace app\controllers;


use app\core\routing\Request;
use app\middlewares\CheckIfAdmin;
use app\models\Contact;
use app\models\User;
use http\Exception\RuntimeException;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->registerMiddleware(new CheckIfAdmin());
    }

    public function index()
    {

        $contacts = Contact::latest(30);
        return view("admin/dashboard", compact('contacts'));
    }

    public function banUser(Request $request)
    {
        $userId = $request->getParamForRoute("/ban/user/");

        $result = User::update(['banned' => 1], ['id' => $userId]);

        if (!$result) {
            throw new \HttpRequestException();
        }

        $user = User::findOne(['id' => $userId]);


        $pastes = $user->pastes();

        foreach ($pastes as $paste){
            $paste->destroy();
        }

        session()->setFlash("success", "User banned successfully");
        return redirect("/");
    }


}