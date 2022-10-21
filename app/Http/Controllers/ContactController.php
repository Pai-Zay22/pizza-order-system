<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct contact page
    public function contactPage(){
        return view('user.main.contact');
    }

    //contact send
    public function contactSend(REQUEST $req){
        $this->validationCheck($req);
        $data = $this->getContactData($req);
        Contact::create($data);
        return redirect()->route('user#homePage');
    }

    //validation contact data
    private function validationCheck($req){
        Validator::make($req->all(),[
            'userName' => 'required',
            'userEmail' => 'required',
            'userPhone' => 'required',
            'message' => 'required',
        ])->validate();
    }

    //requesting contact data
    private function getContactData($req){
        return [
            'name' => $req->userName,
            'email' => $req->userEmail,
            'phone' => $req->userPhone,
            'message' => $req->message,
        ];
    }

}
