{{-- npm run dev is essential to generate usable frontend files after editing any CSS/JS in resources/. Without it, your changes won't appear on the website. --}}
<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="index.html">
        <span>
          Giftos
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  ">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('shop') }}">
              Shop
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('why')}}">
              Why Us
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('testimonial')}}">
              Testimonial
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('contact')}}">Contact Us</a>
          </li>
        </ul>
        <div class="user_option" style="gap:20px;">
          @if (Route::has('login'))
          @auth

          <a href="{{ url('myorders') }}" style="color: rgb(70, 64, 64)">
           My Orders
            [{{$cartCount}}]
          </a>

          <a href="{{ url('mycart') }}">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            [{{$cartCount}}]
          </a>
          <form class="form-inline ">
            <button class="btn nav_search-btn" type="submit">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </form>
          <span></span>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <input class="btn btn-success" type="submit" value="Logout" class="btn nav_search-btn" style="cursor: pointer;">
           
        </form>
         @else
          <a href="{{ url('/login') }}" class="btn nav_search-btn">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>
              Login
            </span>
          </a>
          <a href="{{ url('/register') }}" class="btn nav_search-btn">
            <i class="fa fa-vcard" aria-hidden="true"></i>
            <span>
              Register
            </span>
          </a>
          @endauth
          @endif

        
        </div>
      </div>
    </nav>
  </header>