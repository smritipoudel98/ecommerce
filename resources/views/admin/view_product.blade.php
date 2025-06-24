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
        .table_deg{
            border:2px solid rgb(47, 213, 255);
        }
        th{
            background-color: #068ebc;
            color: white;
            font-size: 20px;
            font-weight: bold;
            padding: 10px;
            border: 1px solid rgb(47, 217, 255);
        }
        td{
            border:1px solid skyblue;
            text-align: center;
        }
    </style>    
      </head>

  <body>
  @include('admin.header')

@include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <div class="div_deg">
                <table class="table_deg">
                    <tr>
                        <th>Product Title</th>
                        <th>Product Description</th>
                        <th>Product Category</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Product Image</th>
                    </tr>
                    @foreach($product as $product)
                    <tr>
                       <td>{{$product->title}}</td>
                       <td>{{$product->description}}</td>
                       <td>{{$product->price}}</td>
                       <td>{{$product->category}}</td>
                       <td>{{$product->quantity}}</td>
                       <td><img height="100" width="100" src="products/{{$product->image}}" alt="{{$product->title}}" style="width: 100px; height: 100px;"></td>
                    </tr>
                   @endforeach
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
      </div>
  </body>
</html>