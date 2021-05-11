<?php

namespace app\controllers;

use app\core\Application;
use app\core\routing\Request;
use app\models\Contact;

class ContactController extends Controller
{
    public function index(){
        $contact = new Contact();
        return view('contact', [
            'model' => $contact
        ]);
    }

    public function store(Request $request){
        $body = $request->getBody();
        $contact = new Contact();
        $contact->loadData($body);
        if($request->validate($contact->rules()) && $contact->send()){
            session()->setFlash('success', 'Thanks for your message!');
            redirect('/contact');
        }

        return view('contact', [
            'model' => $contact
        ]);
    }
}