<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function categories() {
        Session::put('page', 'categories');
        $categories = Category::with('parentCategory')->get();
        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else{
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status, 'category_id'=>$data['category_id']]);
        }
    }

    public function deleteCategory($id) {
        Category::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Category Successfully Deleted');
    }

    public function addEditCategory(Request $request, $id = null) {
        $getCategories = Category::getCategories();
        if($id=="") {
            $title = "Add Category";
            $category = new Category;
            $message = "Category added successfully";
        } else {
            $title = "Edit Category";
            $category = Category::find($id);
            $message = "Category updated successfully";
        }

        if($request->isMethod('post')) {
            $data = $request->all();

            if($id == "") {
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required|unique:categories'
                ];
            } else {
                $rules = [
                    'category_name' => 'required',
                    'url' => 'required'
                ];
            }
            $this->validate($request, $rules);

            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->url = $data['url'];
            $category->category_description = $data['category_description'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message', $message);
        }

        return view('admin.categories.add_edit_category')->with(compact('title', 'getCategories', 'category'));
    }
}
