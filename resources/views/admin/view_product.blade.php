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
            color: white;
        }
    </style>  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  
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
                    @foreach($product as $products)
                    <tr>
                       <td>{{$products->title}}</td>
                       <td>{!! Str::limit($products->description,50) !!}</td>
                       <td>{{$products->price}}</td>
                       <td>{{$products->category}}</td>
                       <td>{{$products->quantity}}</td>
                       <td><img height="100" width="100" src="products/{{$products->image}}" alt="{{$products->title}}" style="width: 100px; height: 100px;"></td>
                    </tr>
                   @endforeach
                </table>
            </div>
            <div class="div_deg">
                {{ $product->onEachSide(1)->links() }}
            </div>
            
          </div>
        </div>
      </div>
    </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  </body>
</html>