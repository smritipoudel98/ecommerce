
    
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        <nav id="sidebar">
          <!-- Sidebar Header-->
          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar"><img src="{{asset('admincss/img/avatar-6.jpg')}}" alt="..." class="img-fluid rounded-circle"></div>
            <div class="title">
              <h1 class="h5">Smriti Poudel</h1>
              <p>Web Designer</p>
            </div>
          </div>
          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">
            <li class="active"><a href="{{ route('admin.home') }}"> <i class="icon-home"></i>Home </a></li>
            <li><a href="{{url('view_category')}}"> <i class="icon-grid"></i>Category </a></li>

            <li>
              <a href="#exampledropdownDropdown" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="icon-windows"></i> Products
              </a>
              <ul id="exampledropdownDropdown" class="collapse list-unstyled">
                <li><a href="{{ url('add_product') }}">Add Product</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Page</a></li>
              </ul>
            </li>
            
                 
          
        </nav>
        <!-- Sidebar Navigation end-->
        <!-- Bootstrap JS (needed for collapse to work) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
