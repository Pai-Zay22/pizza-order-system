<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    //direct change password page
    public function changePasswordPage(){
        return view('admin.account.changePasswordPage');
    }

    //admin change password
    public function changePassword(REQUEST $req){
        $this->passwordValidationCheck($req);
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

    //admin account update
    public function accountUpdate(Request $req,$id){
        $this->userDataValidationCheck($req);
        $data = $this->getUserData($req);

        //for image
        if($req->hasFile('image')){
           $dbImage = User::where('id',$id)->first();
           $dbImage = $dbImage->image; // get old image name from db

           if($dbImage !== null){ // if old image exists delete it
                Storage::delete('public/'.$dbImage);
           }
            $file = $req->file('image');
           $imageName = uniqid().$file->getClientOriginalName();
           $file->storeAs('public/',$imageName);//store in project
           $data['image'] = $imageName;// store in db
        }
        User::where('id',$id)->update($data);
        return redirect()->route('admin#accountInfoPage')->with(['updateSuccess' => 'Your account info updated Successfully!']);
    }

    //direct admin list page
    public function adminListPage(){
        $admin = User::where('role','admin')
                ->when(request('key'),function($query){
                 $query->orWhere('name','like','%'.request('key').'%')
                        ->orwhere('email','like','%'.request('key').'%')
                        ->orwhere('phone','like','%'.request('key').'%')
                        ->orwhere('address','like','%'.request('key').'%');
                })->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.adminListPage',compact('admin'));
    }

    //ajax admin role change
    public function ajaxRoleChange(REQUEST $req){
       $status = User::where('id',$req->adminId)
                ->update([
                    'role' => $req->status,
                ]);
    }
    //requesting user data
    private function getUserData($req){
        return[
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'gender' => $req->gender,
        ];
    }
    //user data validation check
    private function userDataValidationCheck($req){
        Validator::make($req->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',

        ])->validate();
    }


    //password validation check
    private function passwordValidationCheck($req){
        Validator::make($req->all(),[
            'oldPassword' => 'required|min:5|max:10',
            'newPassword' => 'required|min:5|max:10',
            'confirmPassword' => 'required|min:5|max:10|same:newPassword',
            'image' => 'mimes:jpg,jpeg,png,file',
        ])->validate();
    }
}
