<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
      .div_deg {
         display: flex;
         align-items: center;
         background-color: #2d3035;
         margin: 30px;
         padding: 20px;
         border-radius: 8px;
      }
      input[type="text"] {
         color:gray;
         display: flex;
         align-items: center;
         text-align: center;
      }
      .table_deg{
        text-align: center;
        margin:auto;
        border:2px solid yellowgreen;
        margin-top: 50px;
        width: 600px;
        
      }
      th{
        background-color: #2d3035;
        color: white;
        padding: 10px;
        font-size: 20px;
        font-weight: bold;
        color: white;
       
      }
      td{
        color: white;
        padding: 10px;
        border:1px solid skyblue;
       
      }
      .table_deg tr {
  border-bottom: 1px solid skyblue;
}
.table_deg th {
  background:gray;
}
 #delete{
  background-color: red;
 }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
  </head>

  <body>
    {{-- alert for the success on top of the header --}}
    @if (session('success'))
    <div id="success-alert" class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
      <strong>{{ session('success') }}</strong> 
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
      // Auto-dismiss after 5000ms (5 seconds)
      setTimeout(function () {
          var alertEl = document.getElementById('success-alert');
          if (alertEl) {
              var alert = bootstrap.Alert.getOrCreateInstance(alertEl);
              alert.close();
          }
      }, 5000);
  </script>
  @endif

  {{-- form validation error --}}
  @if ($errors->any())
  <div class="alert alert-danger" style="margin: 20px;">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <div class="container-fluid">
          <div class="d-flex justify-content-start mt-3 ms-3">
            <h1 class="mb-0" style="white-space: nowrap; color: white;">Add Category</h1>
          </div>

          <form method="post" action="{{ url('add_category') }}">
            @csrf
            <div class="d-flex justify-content-end mt-3 me-3">
              <input type="text" name="category" placeholder="Write Category Name" class="form-control w-auto text-end">
              <input class="btn btn-primary ms-2" type="submit" value="Add Category">
            </div>
          </form>
        </div>
        <div>
          <table class="table_deg">
              <tr>
               <th>Category Name</th>
               <th>Edit</th>
               <th>Delete</th>
              </tr>
              @foreach($data as $category)
              <tr>
               <td>{{$category->category_name}}</td>
               <td>
                  <a href="{{ url('edit_category/' . $category->id) }}" class="btn btn-success">Edit</a>
               </td>
               <td>
  <form id="delete-form-{{ $category->id }}" action="{{ url('delete_category/' . $category->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button id="delete" type="button" onclick="confirmDelete({{ $category->id }})">Delete</button>
  </form>
</td>
              </tr>
              @endforeach
          </table>
      </div>

      @include('admin.footer')
    </div>
    </div>

    <!-- JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function confirmDelete(categoryId) {
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
        // Submit the form manually
        document.getElementById('delete-form-' + categoryId).submit();
      }
    });
  }
</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>

  
<!-- Bootstrap JS (Required for dismiss button to work) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
