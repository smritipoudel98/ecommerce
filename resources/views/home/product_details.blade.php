<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
      .div_center{
        display:flex;
        justify-content:center;
        align-items:center;
        padding:30px;
      }
       .detail-box{
        padding:15px;
       }
        </style>
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

  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

 <!-- product details starts here. -->
 <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        
        <div class="col-md-12">
          <div class="box">
              <div class="div_center">
                <img src="/products/{{$data->image}}" style="width: 400px;" alt="">
              </div>

              <div class="detail-box">
                <h6>Title:<span>{{$data->title}}</span></h6>
                <h6>Price:<span>${{$data->price}}</span></h6>
              </div>
              <div class="new">
                <span> New</span>
              </div>

              <div class="detail-box">
                <h6>Category:<span>{{$data->category}}</span></h6>
                <h6>Available Quantity:<span>{{$data->quantity}}</span></h6>
              </div>
              <div class="new">
                <span> New</span>
              </div>
              
              <div class="detail-box">
                <p>{{$data->description}}</p>
              </div>
          </div>
          
      
    </div>
  </section>
  <!-- product details ends here. -->
  
@include('home.footer')

  <!-- info section -->



</body>

</html>