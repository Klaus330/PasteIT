<?php


namespace app\controllers;


use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{


    public function index()
    {

    }

    public function login(Request $request)
    {

    }

    public function register(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('register');
    }
}