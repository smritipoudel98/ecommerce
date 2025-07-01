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


  </div>
  <!-- end hero area -->
<!-- Stripe Payment Form -->


  <!-- shop section -->

 @include('home.product')
  <!-- end shop section -->




  


</body>

</html>