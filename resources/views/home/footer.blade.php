<section class="info_section layout_padding2-top">
  <style>
    .info_section {
      padding-top: 40px;
      background-color: #131517;
    }

    .info_container .row > div {
      margin-bottom: 30px;
    }

    .info_container h3,
    .info_container h6 {
      margin-bottom: 15px;
      font-weight: 600;
      color: white;
    }

    .info_container p {
      line-height: 1.7;
      color: white;
    }

    .info_link-box a {
      display: block;
      margin-bottom: 10px;
      color: white;
      text-decoration: none;
    }

    .info_link-box i {
      margin-right: 8px;
      color: #ff5722;
    }

    .social_container {
      padding-bottom: 20px;
    }
    .gift-image {
      width: 100px;
      height: auto;
      margin-top: 30px;
    }

    @media (min-width: 992px) {
      .info_container .col-lg-3 {
        padding: 0 20px;
      }
    }
  </style>

  <!-- Social Media Section -->
  <div class="social_container">
    <div class="social_box">
      <a href="https://www.linkedin.com/in/smriti-poudel-375a1626a/">
        <i class="fa fa-linkedin" aria-hidden="true"></i>
      </a>
      <a href="https://github.com/smritipoudel98">
        <i class="fa fa-github" aria-hidden="true"></i>
      </a>
    </div>
  </div>

  <!-- Info Container -->
  <div class="info_container">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <h3>ABOUT US</h3>
          <p>
            Welcome to our gift shop — your trusted destination for meaningful and memorable gifts. We are dedicated to offering unique, high-quality products that help you celebrate life's special moments with ease and joy.
          </p>
        </div>

        <div class="col-md-6 col-lg-3">
          <h3>NEED HELP</h3>
          <p>
            Have questions or need assistance? Our support team is here to help you with orders, shipping, returns, or product information. Reach out anytime — we're happy to assist you!
          </p>
        </div>

        <div class="col-md-6 col-lg-3">
          <h3>Gift</h3>
          <img src="{{ asset('images/saving-img.png') }}" class="gift-image">
        </div>
        <div class="col-md-6 col-lg-3">
          <h6>CONTACT US</h6>
          <div class="info_link-box">
            <a href="https://www.google.com/maps?q=Kathmandu,Nepal" target="_blank">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>Kathmandu, Nepal</span>
            </a>
            <a href="tel:+977 9864676207">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>+977 9864676207</span>
            </a>
            <a href="mailto:psmriti6207@gmail.com">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>psmriti6207@gmail.com</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer Section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">Smriti Poudel</a>
      </p>
    </div>
  </footer>
</section>

<!-- Scripts -->
<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>