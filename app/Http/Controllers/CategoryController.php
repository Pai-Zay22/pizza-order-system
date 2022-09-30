<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // admin category list
    public function list(){
        $categories = Category::when(request('key'),function($query){
                      $searchKey = request('key');
                      $query->where('name','like','%'.$searchKey.'%');
                    })->orderby('id','desc')
                    ->paginate(5);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //admin category create page
    public function createPage(){
        return view('admin.category.createPage');
    }

    //admin category create
    public function create(REQUEST $req ){
        $this->categoryCreateValidationCheck($req);
        $data = $this->categoryGetData($req);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //admin catergory delete
    public function delete($id){
        Category::where('id',$id)->delete();
        return back();
    }

    //admin category edit
    public function edit($id,REQUEST $req){
        $editPost = Category::where('id',$id)->first();
        // dd($editPost->toArray());
        return view('admin.category.edit',compact('editPost'));
    }

    //admin category update
    public function update(REQUEST $req){
        $this->categoryCreateValidationCheck($req);
        $data = $this->categoryGetData($req);
        $id = $req['categoryId'];
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list')->with(['categoryUpdate' => 'Category Updated Sucessfully!'] );
    }

    //category get data from client side
    private function categoryGetData($req){
        return[
            'name' => $req->categoryName,
        ];
    }

    // category create validation check
    private function categoryCreateValidationCheck($req){
        $validationRules = [
            'categoryName' => 'required|min:4|unique:categories,name,'.$req->categoryId,
        ];
        $validationMessage = [
            'categoryName.required' => 'Please fill the category name!'
        ];
        Validator::make($req->all(),$validationRules,$validationMessage)->validate();
    }
}
