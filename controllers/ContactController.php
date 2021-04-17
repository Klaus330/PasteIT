<?php

namespace app\controllers;

use app\core\Application;
use app\core\Request;
use app\models\Contact;

class ContactController extends Controller
{
    public function index(){
        $contact = new Contact();
        return $this->render('contact', [
            'model' => $contact
        ]);
    }

    public function store(Request $request){
        $body = $request->getBody();
        $contact = new Contact();
        $contact->loadData($body);
        if($request->validate($contact->rules()) && $contact->send()){
            Application::$app->session->setFlash('success', 'Thanks for your message!');
            $this->redirect('/contact');
        }

        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}