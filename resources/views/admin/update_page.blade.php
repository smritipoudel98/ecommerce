<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style>
    .div_deg {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #2d3035;
        margin-top: 60px;
    }
    label {
        display: inline-block;
        width: 200px;
        padding: 10px;
    }
    .form-field {
        width: 300px;
        height: 40px;
        margin-bottom: 15px;
        padding: 8px;
    }
    textarea.form-field {
        height: 150px;
    }
</style>

      </head>

  <body>
   
  @include('admin.header')

@include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
           <h2>Update Product</h2>
           <div class="div_deg">
            <form action="{{ url('edit_product',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label>Product Title</label>
                    <input type="text" name="title" value="{{ $product->title }}" class="form-field">
                </div>
                
                <div>
                    <label>Product Description</label>
                    <textarea name="description" class="form-field">{{ $product->description }}</textarea>
                </div>
                
                <div>
                    <label>Product Category</label>
                    <select name="category" class="form-field" style="background-color: white; color: black;">
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_name }}" 
                                {{ $product->category === $category->category_name ? 'selected' : '' }}>
                                {{ ucfirst($category->category_name) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label>Product Quantity</label>
                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-field">
                </div>
                
                <div>
                    <label>Product Price</label>
                    <input type="text" name="price" value="{{ $product->price }}" class="form-field">
                </div>
                
                <div>
                    <label>Current Image</label>
                    <img width="100" src="/products/{{ $product->image }}">
                </div>
                
                <div>
                    <label>New Image</label>
                    <input type="file" name="image" class="form-field">
                </div>
                
                <div>
                    <input class="btn btn-success" type="submit" name="submit" value="Update Product">
                </div>
                
        
        @include('admin.footer')
      </div>
    </div>
      </div>
    <!-- JavaScript files-->
  
    
  </body>
</html>