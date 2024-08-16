<!DOCTYPE html>
<html lang="en">

<x-depan.head />
<body class="index-page">

<x-depan.navbar />

  <main class="main">

    <!-- Hero Section -->
   <x-depan.hero />
    <!-- /Hero Section -->

    <!-- About Section -->
    <x-depan.about />
    <!-- /About Section -->

    <!-- Stats Section -->
    <x-depan.stat />
    <!-- /Stats Section -->

    <!-- Services Section -->
    <x-depan.service />
    
    <!-- /Services Section -->

    <!-- Features Section -->
   <x-depan.features />
    
    <!-- /Features Section -->

    <!-- Pricing Section -->
    <x-depan.paket />
   <!-- /Pricing Section -->

    <!-- Faq Section -->
    <x-depan.faq />
   <!-- /Faq Section -->

    
    <!-- Contact Section -->
    <x-depan.kontak />
  <!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer accent-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">AQT Network</span>
          </a>
          <p>Solusi Internet Rumah Dengan Harga Murah<br>CCTV, Hotspot, Rumahan, Dedicated Internet</p>

          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Tentang</a></li>
            <li><a href="#">Pelayanan</a></li>
            <li><a href="#">Paket Internet</a></li>
            <li><a href="#">FAQ</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">CCTV</a></li>
            <li><a href="#">Rakit Komputer</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Indramayu, Sindangkerta</p>
          <p>Kec. Lohbener, Kab. Indramayu</p>
          <p>Indonesia</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+62 819-1517-0773</span></p>
          <p><strong>Email:</strong> <span>aqtnetwork@gmail.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">AQT Network</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="#">AQT Network</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>