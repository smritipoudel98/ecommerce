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


  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
<!-- Add this just below @include('home.header') -->
@if(session('success'))
    <div class="alert alert-success text-center" style="width: 50%; margin: 20px auto;">
        {{ session('success') }}
    </div>
@endif

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
          
          <div class="detail-box">
            <a class="btn btn-primary"href="{{url('add_cart',$data->id)}}">Add to Cart</a>

          </div>
      </div>
      
    </div>
  </section>
  <!-- product details ends here. -->
  
@include('home.footer')

  <!-- info section -->

  <script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000); // hides after 3 seconds
</script>


</body>

</html>