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
        label{
            display:inline-block;
            width: 200px;
            padding: 10px;
        }
        input[type="text"]{
            width=100px;
            height: 60px;
        }
        textarea{
            width=450px;
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
                    <input type="text" name="title" value="{{ $product->title }}">
                </div>
                 <label></label>
                <div>
                    <label>Product Description</label>
                    <textarea name="description">{{$product->description}}</textarea>
                </div>

                <div>
                    <label>Product Category</label>
                    <select name="category">
                            <option value="{{ $product->category }}" >{{ $product->category }}</option>
                    </select>
                </div>
                <div>
                    <label>Product Quantity</label>
                    <input  type="number" name="quantity" value="{{ $product->quantity }}">
                </div>
                <div>
                    <label>Product Price</label>
                    <input type="text" name="price" value="{{ $product->price }}">
                </div>
                <div>
                    <label>Current Image</label>
                    <img width="100" src="/products/{{ $product->image}}">
                 </div>
                 <div>
                    <label>New Image</label>
                    <input type="file" name="image">
                 </div>
                 <div>

                     <input class="btn btn-success"type="submit" name="submit" value="Update Product">
                </div>
            </form>
           </div>
        
        @include('admin.footer')
      </div>
    </div>
      </div>
    <!-- JavaScript files-->
  
    
  </body>
</html>