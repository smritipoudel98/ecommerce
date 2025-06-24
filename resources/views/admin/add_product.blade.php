<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
      .div_deg {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #2d3035;
        margin-top: 20px;
        padding: 20px;
        border-radius: 8px;
      }
      #add-product {
        font-size: 40px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
      }
      form > div {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
      }

      form input,
      form textarea,
      form select {
        flex: 1;
        color: gray;
        background-color: transparent;
        border: 1px solid #ccc;
        width: 100%;
        padding: 5px;
      }
      label {
        display: inline-block;
        color: white;
        font-size: 20px;
        font-weight: bold;
        width: 150px;
      }
      .submitt {
        justify-content: flex-end;
      }

      .submitt input[type="submit"] {
        background-color: #28a745;
        padding: 10px 20px;
        color: white;
        border: none;
        cursor: pointer;
      }
    </style> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
    @if(session('success'))
    <div id="success-alert" class="alert alert-success alert-dismissible fade show mt-3 mx-3"
         role="alert" data-bs-theme="dark">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  
    <script>
      setTimeout(function () {
        var alertEl = document.getElementById('success-alert');
        if (alertEl) {
          var alert = bootstrap.Alert.getOrCreateInstance(alertEl);
          alert.close();
        }
      }, 5000);
    </script>
  @endif
  

    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <h1 id="add-product">Add Product</h1>
          <div class="div_deg">
            <form action="{{url('upload_product')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div>
                <label>Product Title</label>
                <input type="text" name="title" placeholder="Write a title" class="form-control" style="color: white; background-color: transparent; border: 1px solid #ccc; width: 100%;" required>  
              </div>  
              <div>
                <label>Description</label>
                <textarea name="description" placeholder="Write a description" class="form-control" style="color: white; background-color: transparent; border: 1px solid #ccc; width: 100%;" required></textarea>
              </div>  
              <div>
                <label>Product Price</label>
                <input type="text" name="price" class="form-control" style="color: white; background-color: transparent; border: 1px solid #ccc; width: 100%;" required>  
              </div> 
              <div>
                <label>Product Quantity</label>
                <input type="number" name="qty" class="form-control" style="color: white; background-color: transparent; border: 1px solid #ccc; width: 100%;" required>  
              </div> 
              <div>
                <label>Product Images</label>
                <input type="file" name="images[]" class="form-control" style="color: white; background-color: transparent; border: 1px solid #ccc; width: 100%;" multiple required>  
              </div> 
              <br>
              <div>
                <label>Product Category</label>
                <select name="category" required>
                  <option>Select an option</option>
                  @foreach ($category as $category)   
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                  @endforeach
                </select>
              </div> 
              <div class="submitt">
                <label></label> 
                <input type="submit" value="Add Product" class="btn btn-success" style="margin-top: 10px; border: none; padding: 10px 20px; color: white; cursor: pointer; width: 10%;">
              </div>
            </form>    
          </div>   
          @include('admin.footer')
        </div>
      </div>
    </div>

    <!-- ✅ Bootstrap 5 bundle required for alert close functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGFcG7NQjjJw2y+f7HMBRJdSJHczKvZ5p7cZL9AY1JXK" crossorigin="anonymous"></script>
  </body>
</html>
