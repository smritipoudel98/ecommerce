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
    @if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<script>
    // Auto-close after 5 seconds
    setTimeout(function () {
        const alert = document.getElementById('success-alert');
        if (alert) {
            // Bootstrap 4 uses jQuery’s .alert('close') method
            $(alert).alert('close');
        }
    }, 5000);
</script>
@endif


  @include('admin.header')

@include('admin.sidebar')
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <form action="{{ url('product_search') }}" method="get" >
              <input type="search" name="search" placeholder="Search for products..." class="form-control" style="width: 300px; height: 50px; display: inline-block; margin-right: 5px;">
              <button type="submit" class="btn btn-secondary" value="Search" style="display: inline-block; margin-left: 5px;">Search</button>
            </form>

            <div class="div_deg">
                <table class="table_deg">
                    <tr>
                        <th>Product Title</th>
                        <th>Product Description</th>
                        <th>Product Category</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Product Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach($product as $products)
                    <tr>
                       <td>{{$products->title}}</td>
                       <td>{!! Str::limit($products->description,50) !!}</td>
                       <td>{{$products->category}}</td>
                       <td>{{$products->price}}</td>
                       <td>{{$products->quantity}}</td>
                       <td><img height="100" width="100" src="products/{{$products->image}}" alt="{{$products->title}}" style="width: 100px; height: 100px;"></td>
                       <td>
                        <a href="{{ url('update_product', $products->id) }}" class="btn btn-success">Edit</a>
                       </td>
                       
                       <td>
                        <form id="delete-form-{{ $products->id }}" action="{{ url('delete_product', $products->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $products->id }})">Delete</button>
                        </form>
         
                      </td>
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
       <!-- JavaScript files -->
    <!-- Add jQuery first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

       @if(session('message'))
       <script>
        //  Calls the SweetAlert2 library's fire() method to create a toast (popup alert).
         Swal.fire({
            //"Make this a toast notification" (a small popup at the corner) instead of a full modal.
           toast: true,
           position: 'top-end',
           icon: '{{ session('alert-type', 'info') }}', // default to 'info'
           //This sets the text/title of the popup message using the value stored in Laravel’s session.
           title: @json(session('message')),
           showConfirmButton: false,
           timer: 3000
         });
       </script>
       @endif
       <script>
        function confirmDelete(productId) {
          Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById('delete-form-' + productId).submit();
            }
          });
        }
      </script>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
     @include('admin.js')
  </body>
</html>