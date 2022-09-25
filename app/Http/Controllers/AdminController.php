<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    //direct change password page
    public function changePasswordPage(){
        return view('admin.account.changePasswordPage');
    }

    //admin change password
    public function changePassword(REQUEST $req){
        //$this->passwordValidationCheck($req);
        $id = Auth::user()->id;
        $oldPw = User::select('password')->where('id',$id)->first();
        $dbHashValue = $oldPw->password;// get hash pw from db

        if(Hash::check($req->oldPassword, $dbHashValue)){// checking old pw and db pw same or not
            $data = ['password' => Hash::make($req->newPassword)];
            User::where('id',$id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage')->with(['changePw' => 'Your password has changed successfully.Please log in again!']);
        }else{
           return back()->with(['notMatch' => "The old Password didn't match.Please try again! "]);
        }

    }

    //direct account info page
    public function accountInfoPage(){
        return view('admin.account.accountInfoPage');
    }

    //direct account edit page
    public function accountEditPage(){
        return view('admin.account.accountEditPage');
    }

    //password validation check
    private function passwordValidationCheck($req){
        Validator::make($req->all(),[
            'oldPassword' => 'required|min:5|max:10',
            'newPassword' => 'required|min:5|max:10',
            'confirmPassword' => 'required|min:5|max:10|same:newPassword',
        ])->validate();
    }
}
