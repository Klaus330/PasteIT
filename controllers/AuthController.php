<?php


namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

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