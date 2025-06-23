<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category;
        $category->save();
        return redirect()->back()->with('success', 'Category added successfully!')
        ->with('alert-type', 'success');
    }
    public function delete_category($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!')
        ->with('alert-type', 'danger');
    }

   // To display the form
public function edit_category_form($id) {
    $category = Category::find($id);
    return view('admin.edit_category', compact('category'));
    //	compact()	=Converts variable names into an array
}

public function edit_category(Request $request, $id)
{
    $category = Category::findOrFail($id);
    $category->name = $request->input('name');
    $category->save();
    return redirect()->back()->with('message', 'Category updated');
}

public function update_category(Request $request, $id) {
    $category = Category::find($id);
    $category->category_name = $request->category;
    $category->save();

    return redirect('/view_category')->with('success', 'Category updated successfully!');
}

public function add_product(){
    return view('admin.add_product');
}

    public function admin_home()
{
    return view('admin.index');
}

}