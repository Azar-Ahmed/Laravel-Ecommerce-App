<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index(){
        $category=Category::latest()->paginate(10);
        return view('admin.category.list', compact('category'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $validate = Validator::make($request->all(), [
             'name' => 'required|regex:/^[a-zA-Z\s]+$/',
        ]);

        if($validate->passes()){
            $slug = Str::slug($request->name);

            $category = Category::where('slug', $slug)->first();
            if($category){
                return back()->with('error', 'Category Already Exist');
            }
            Category::create([
                'name' => $request->name,
                'slug' => $slug,
            ]);

            return redirect()->route('category.index')->with('success','Category Added Successfully');
        }else{
            return back()->with('error', 'Please enter correct category name');
        }
    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id){

    }
    public function destroy(){

    }
}
