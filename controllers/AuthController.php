<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Validator;
use app\models\User;

class AuthController extends Controller
{
    public function index()
    {
        $user = new User();
        return $this->render("auth/login", ['model' => $user]);
    }

    public function login(Request $request)
    {
        $isValid = $request->validate([
            'email' => [Validator::RULE_REQUIRED, Validator::RULE_EMAIL],
            'password' => [Validator::RULE_REQUIRED]
        ]);
        $user = new User();
        if($isValid){
            $user->loadData($request->getBody());

            if($user->login()) {
                $this->flash('success', 'You are logged in');
                $this->redirect('/user/profile');
            }
        }

        return $this->render('auth/login', [
            'model' => $user,
            'errors' => $request->getErrors()
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        if($request->isPost()){
            if($request->validate($user->rules())){
                $user->loadData($request->getBody());
                $user->save();


               $this->flash('success', 'You are registered');
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

    public function logout()
    {
        Application::$app->logout();
        $this->redirect('/');
    }
}