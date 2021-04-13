<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{


    public function index()
    {
        return $this->render("auth/login");
    }

    public function login(Request $request)
    {
        return $this->render("home");
    }

    public function register(Request $request)
    {
        $user = new User();
        if($request->isPost()){
            if($request->validate($user->rules())){
                $user->loadData($request->getBody());
                $user->save();
               $this->redirect('/');
            }

            return $this->render('auth/register', [
                'model' => $user,
                'errors' => $request->getErrors()
            ]);
        }

        return $this->render('auth/register', [
            'model' => $user
        ]);
    }

    public function forgotPassword(Request $request)
    {
        return $this->render("auth/forgot-password");
    }

    public function resetPassword(Request $request)
    {
        return $this->render("auth/reset-password");
    }
}