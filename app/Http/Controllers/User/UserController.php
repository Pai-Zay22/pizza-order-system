<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //direct user home page
    public function homePage(){
        $product = Product::get();
        $category = Category::get();
        return view('user.main.home',compact('product','category'));
    }

    //filter by category
    public function filter($categoryId){
        $product = Product::where('category_id',$categoryId)->get();
        $category = Category::get();
        return view('user.main.home',compact('product','category'));
    }

    //direct password change page
    public function passwordChangePage(){
        return view('user.account.passwordChangePage');
    }

     //user change password
     public function passwordChange(REQUEST $req){
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

    //direct user account update page
    public function accountUpdatePage(){
        return view('user.account.accoutUpdatePage');
    }

      //user account update
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
        return redirect()->route('user#homePage');
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
