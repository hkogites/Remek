@extends('layouts.base')

@section('title', 'Trips — Home')

@section('body')
<div class="site-wrap" id="home-section">
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  @include('partials.header')

  <div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" style="background-image: url('{{ asset('oldal/images/hero_1.jpg') }}')">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-5" data-aos="fade-right">
            <h1 class="mb-3 text-white">what</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta veritatis in tenetur doloremque, maiores doloribus officia iste. Dolores.</p>
            <p class="d-flex align-items-center">
              <a href="https://vimeo.com/191947042" data-fancybox class="play-btn-39282 mr-3"><span class="icon-play"></span></a>
              <span class="small">Watch the video</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  @yield('home-content')

  <footer class="site-footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <h2 class="footer-heading mb-3">Instagram</h2>
          <div class="row">
            <div class="col-4 gal_col"><a href="#"><img src="{{ asset('oldal/images/insta_1.jpg') }}" alt="Image" class="img-fluid"></a></div>
            <div class="col-4 gal_col"><a href="#"><img src="{{ asset('oldal/images/insta_2.jpg') }}" alt="Image" class="img-fluid"></a></div>
            <div class="col-4 gal_col"><a href="#"><img src="{{ asset('oldal/images/insta_3.jpg') }}" alt="Image" class="img-fluid"></a></div>
            <div class="col-4 gal_col"><a href="#"><img src="{{ asset('oldal/images/insta_4.jpg') }}" alt="Image" class="img-fluid"></a></div>
            <div class="col-4 gal_col"><a href="#"><img src="{{ asset('oldal/images/insta_5.jpg') }}" alt="Image" class="img-fluid"></a></div>
            <div class="col-4 gal_col"><a href="#"><img src="{{ asset('oldal/images/insta_6.jpg') }}" alt="Image" class="img-fluid"></a></div>
          </div>
        </div>
        <div class="col-lg-8 ml-auto">
          <div class="row">
            <div class="col-lg-6 ml-auto">
              <h2 class="footer-heading mb-4">Quick Links</h2>
              <ul class="list-unstyled">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul>
            </div>
            <div class="col-lg-6">
              <h2 class="footer-heading mb-4">Newsletter</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt odio iure animi ullam quam, deleniti rem!</p>
              <form action="#" class="d-flex" class="subscribe">
                <input type="text" class="form-control mr-3" placeholder="Email">
                <input type="submit" value="Send" class="btn btn-primary">
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row pt-5 mt-5 text-center">
        <div class="col-md-12">
          <div class="border-top pt-5">
            <p>
              Copyright &copy;<script>document.write(new Date().getFullYear());</script>
              All rights reserved | This template is made with <i class="icon-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</div>
@endsection

