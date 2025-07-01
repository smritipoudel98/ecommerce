<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .form-group{
             display: flex;
             justify-content: center;
             align-items: center;
             width:50%;
             padding:10px;
             margin:20px;
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
<br><br>
    <div class="container mb-5">
        <h4 style="text-align:center">Leave a Testimonial</h4>
        <form action="{{ route('testimonial.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Your name" required>
          </div>
          <div class="form-group">
            <input type="text" name="designation" class="form-control" placeholder="Your profession (optional)">
          </div>
          <div class="form-group">
            <textarea name="message" class="form-control" placeholder="Your testimonial" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="carousel-inner">
        @foreach($testimonials as $key => $testimonial)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
          <div class="box">
            <div class="client_info">
              <div class="client_name">
                <h5>{{ $testimonial->name }}</h5>
                <h6>{{ $testimonial->designation ?? 'Customer' }}</h6>
              </div>
              <i class="fa fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>{{ $testimonial->message }}</p>
          </div>
        </div>
        @endforeach
      </div>
            

</body>

</html>