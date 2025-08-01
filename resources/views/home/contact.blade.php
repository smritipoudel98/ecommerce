<!DOCTYPE html>
<html>

<head>
    @include('home.css')
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

  <!-- info section -->
  <section class="contact_section ">
    <div class="container px-0">
      <div class="heading_container ">
        <h2 class="">
          Contact Us
        </h2>
      </div>
    </div>
    <div class="container container-bg">
      <div class="row">
        <div class="col-lg-7 col-md-6 px-0">
          <div class="map_container">
            <div class="map-responsive">
              <iframe
                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Kathmandu,Nepal"
                width="600"
                height="300"
                frameborder="0"
                style="border:0; width: 100%; height:100%"
                allowfullscreen>
              </iframe>
            </div>
            
          </div>
        </div>
        <div class="col-md-6 col-lg-5 px-0">
          <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Your name" required><br>
            <input type="email" name="email" placeholder="Your email" required><br>
            <textarea name="message" placeholder="Your message" required></textarea><br>
            <button type="submit">Send Message</button>
        </form>  
        </div>
      </div>
    </div>
  </section>

  <br><br><br>

  


</body>

@include('home.footer')
</html>