<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct pizza list page
    public function pizzaListPage(){
        $pizzas = Product::orderby('id','desc')->paginate(3);
        return view('admin.product.pizzaListPage',compact('pizzas'));
    }

    //direct pizza create page
    public function pizzaCreatePage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.pizzaCreatePage',compact('categories'));
    }

    //creating pizza
    public function pizzaCreate(REQUEST $req){
        $this->pizzaCreateValidationCheck($req);
        $data = $this->pizzaCreateData($req);
        //for image
        $imageName = uniqid().$req->file('pizzaImage')->getClientOriginalName();
        $req->file('pizzaImage')->storeAs('public/',$imageName);//store in project
        $data['image'] = $imageName;//store in db
        Product::create($data);
        return redirect()->route('product#pizzaListPage');
    }

    //requesting pizza create data
    private function pizzaCreateData($req){
        return [
            'name' => $req->pizzaName,
            'description' => $req->pizzaDescription,
            'image' => $req->pizzaImage,
            'category_id' => $req->pizzaCategory,
            'price' => $req->pizzaPrice,
            'waiting_time' => $req->waitingTime,
        ];
    }



    //checking validation
    private function pizzaCreateValidationCheck($req){
        Validator::make($req->all(),[
            'pizzaName' => 'required|unique:products,name|string',
            'pizzaDescription' => 'required|min:10',
            'pizzaImage' => 'required|mimes:png,jpg,jpeg,file',
            'pizzaCategory' => 'required',
            'pizzaPrice' => 'required',
            'waitingTime' => 'required',
        ])->validate();
    }
}
