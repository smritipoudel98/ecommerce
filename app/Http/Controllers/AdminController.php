<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

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
   
     $category=Category::all();

    return view('admin.add_product',compact('category'));
}
public function upload_product(Request $request){
    $category=new Product;
    $category->title = $request->title;
    $category->description = $request->description;
    $category->price = $request->price;
    $category->quantity = $request->qty;
    $category->category = $request->category;
    $image=$request->images;
    // get images from blade
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $image_name = time() . rand(1, 999) . '.' . $image->getClientOriginalExtension();
            $image->move('products', $image_name);
                //move "products"->automatically created in public folder.
            // You can store each image name in DB, or just store the first one
            $category->image = $image_name; // or save to array
        }
    }
    
    $category->save();
   return redirect()->back()->with('success', 'Product Added successfully!');;
}

 public function view_product(){

    $product=Product::paginate(3);
    return view('admin.view_product',compact('product'));
 }

 public function delete_product($id){
    $product = Product::findOrFail($id);
    // images stored in public/products folder,then delete it as well $product->image($product=variable,image=column name of table products in DB)
    $image_path = public_path('products/' . $product->image);
    if (file_exists($image_path)) {
        unlink($image_path); // delete the image file
    //unlink() is used to delete a file from the server.
    }
    $product->delete();

    return redirect('/view_product')->with([
        'message' => 'Product deleted successfully!',
        'alert-type' => 'success'
    ]);
}

public function update_product($id){
    $product=Product::find($id);
    $categories = Category::all();

    return view('admin.update_page', compact('product', 'categories'));
}
public function edit_product(Request $request, $id){
    $product = Product::find($id);
    $product->title = $request->title;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->quantity = $request->quantity;
    $product->category = $request->category;
    $image = $request->image;
    if($image) {
        $image_name=time().rand(1,999).'.'.$image->getClientOriginalExtension();
        //This moves the uploaded image to the public/products/ directory.
        $image->move('products', $image_name);
        $product->image = $image_name;
        //$product->image , this image from database.
        
    }
    $product->save();
    return redirect('/view_product')->with('success', 'Product updated successfully!');
}

public function product_search(Request $request){
    $search_text=$request->search;
    $product=Product::where('title','LIKE','%'.$search_text.'%')
    ->orWhere('category','LIKE','%'.$search_text.'%')->paginate(3);
    return view('admin.view_product',compact('product'));
}

public function admin_home()
{
    return view('admin.index');
}

}