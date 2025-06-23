<!DOCTYPE html>
<html>
<head> 
  @include('admin.css')
  <style type="text/css">
    #update-category-title {
        font-size: 40px;
        font-weight: bold;
        color: white;
        text-align: left;
        margin-bottom: 10px;
    }

    .center-form {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 20vh; 
    }

    .form-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-control {
        color: white;
    }
  </style> 
</head>

<body>
  @include('admin.header')
  @include('admin.sidebar')

  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">

        <!-- Top-left Title -->
        <div class="container mt-4">
          <h1 id="update-category-title">Update Category</h1>
        </div>

        <!-- Centered Form -->
        <div class="container center-form">
          <form method="POST" action="{{ url('update_category/' . $category->id) }}">
            @csrf
            
            <div class="form-wrapper">
              <input type="text" name="category" value="{{ $category->category_name }}" class="form-control w-auto text-end me-2" style="background-color: transparent; border: 1px solid #ccc;">
              <input type="submit" value="Update Category" class="btn btn-primary">
            </div>
          </form>
        </div>

        @include('admin.footer')
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/popper.js/umd/popper.min.js')}}"></script>
  <script src="{{asset('/admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('/admincss/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
  <script src="{{asset('/admincss/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('/admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('/admincss/js/charts-home.js')}}"></script>
  <script src="{{asset('/admincss/js/front.js')}}"></script>
</body>
</html>
