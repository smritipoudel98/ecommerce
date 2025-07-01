<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .container.mb-5 form {
  width: 50%;
  margin: 0 auto; /* center form */
  display: flex;
  flex-direction: column;
  gap: 15px; /* spacing between inputs */
}

.container.mb-5 form input,
.container.mb-5 form textarea {
  width: 100%; /* fill form's width */
  padding: 10px;
  font-size: 1rem;
}

.container.mb-5 form button {
  width: 150px; /* button width */
  align-self: center; /* center button horizontally */
  padding: 10px;
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
      <!-- Testimonial Section -->
<div id="testimonialCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
  
    <!-- Indicators -->
    <ol class="carousel-indicators">
      @foreach($testimonials as $key => $testimonial)
        <li data-target="#testimonialCarousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
      @endforeach
    </ol>
  
    <!-- Carousel items -->
    <div class="carousel-inner">
      @foreach($testimonials as $key => $testimonial)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
          <div class="box p-4">
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
  
    <!-- Controls -->
    <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  
            
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
      
</body>

</html>