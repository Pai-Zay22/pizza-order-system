<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct pizza list page
    public function pizzaListPage(){

        $pizzas = Product::select('products.*','categories.name as category_name')
                ->when(request('key'),function($query){
                    $query->where('products.name','like','%'.request('key').'%');
                })
                ->leftJoin('categories','products.category_id','categories.id')
                ->orderby('products.id','desc')->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaListPage',compact('pizzas'));
    }

    //direct pizza create page
    public function pizzaCreatePage(){
        $categories = Category::select('id','name')->get();
        return view('admin.product.pizzaCreatePage',compact('categories'));
    }

    //creating pizza
    public function pizzaCreate(REQUEST $req){
        $this->pizzaCreateValidationCheck($req,'create');
        $data = $this->pizzaCreateData($req);
        //for image
        $imageName = uniqid().$req->file('pizzaImage')->getClientOriginalName();
        $req->file('pizzaImage')->storeAs('public/',$imageName);//store in project
        $data['image'] = $imageName;//store in db
        Product::create($data);
        return redirect()->route('product#pizzaListPage');
    }

    //pizza delete
    public function pizzaDelete($id){
        Product::where('id',$id)->delete();
        return back();
    }

    //direct pizza info page
    public function pizzaInfo($id){
        $pizza = Product::select('products.*','categories.name as category_name')
                ->leftJoin('categories','products.category_id','categories.id')
                ->where('products.id',$id)->first();
        return view('admin.product.pizzaInfoPage',compact('pizza'));
    }

    //direct pizza update page
    public function pizzaUpdatePage($id){
        $category = Category::get();
        $pizza = Product::where('id',$id)->first();

        return view('admin.product.pizzaUpdatePage',compact('pizza','category'));
    }

    //pizza update process
    public function pizzaUpdate($id,REQUEST $req){
        $this->pizzaCreateValidationCheck($req,'update');
        $data = $this->pizzaCreateData($req);
        // for image
        $dbImage = Product::where('id',$id)->first();
        $dbImage = $dbImage->image;
        if($dbImage !=null){ //deleting old image if exists
            Storage::delete('public'.$dbImage);
            $imageName = uniqid().$req->file('pizzaImage')->getClientOriginalName();
            $req->file('pizzaImage')->storeAs('public/',$imageName);//store in project
            $data['image'] = $imageName;//store in db
            Product::where('id',$id)->update($data);
            return redirect()->route('product#pizzaListPage');
        }
    }

    //requesting pizza data
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
    private function pizzaCreateValidationCheck($req,$action){
        $validationRules = [
            'pizzaName' => 'required|unique:products,name,'.$req->pizzaId,
            'pizzaDescription' => 'required|min:10',
            'pizzaCategory' => 'required',
            'pizzaPrice' => 'required',
            'waitingTime' => 'required',
        ];
        $validationRules['pizzaImage'] = $action == 'create' ? 'mimes:png,jpg,jpeg|file|required': 'mimes:png,jpg,jpeg|file';
        Validator::make($req->all(),$validationRules)->validate();

}
}
