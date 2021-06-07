<?php

namespace app\controllers;

use app\core\Application;
use app\core\routing\Request;
use app\core\Validator;
use app\models\Contact;
use app\models\User;

class ContactController extends Controller
{
    public function index(Request $request){

        $contact = new Contact();


        if($request->has('user')){
            $contact->toUsername = $request->getBody()['user'];
        }

        if($request->has('paste')){
            $contact->toPaste = $request->getBody()['paste'];
        }

        return view('contact', [
            'model' => $contact
        ]);
    }

    public function store(Request $request){
        $body = $request->getBody();


        $reportedUser = User::findOne(['username' => $body['toUsername']]);
        $contact = new Contact();

        if(!$reportedUser){
            Validator::addError('toUsername', "Please insert valid data");
            return view('contact'   , [
                'model' => $contact
            ]);
        }


        $contact->loadData($body);
        if($request->validate($contact->rules()) && $contact->send()){
            session()->setFlash('success', 'Thanks for your message!');
           return redirect('/');
        }

        return view('contact'   , [
            'model' => $contact
        ]);
    }


    public function delete(Request $request)
    {
        $id = $request->getParamForRoute('/report/delete/');

        $report = Contact::findOne(['id'=>$id]);

        if(!$report){
            session()->setFlash('danger','Report not found');
            return redirect('/admin/dashboard');
        }
        $report->destroy();

        session()->setFlash('danger','Report not found');
        return redirect('/admin/dashboard')->withErrors($request->getErrors());
    }
}