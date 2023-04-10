<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Donor</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="top">
    <div class="container d-flex align-items-center">
     <h1 class="logo me-auto"><a href="index.html">Medical Care</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#contact" >Home</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      
      @if (Auth::check())
      @if (Auth::user()->role === 'admin')
          <a href="{{route('data')}}" class="btn-get-started scrollto" style="margin-left: 18px;"><button style="color: #fff">Lihat Data</button></a>   

      @elseif (Auth::user()->role == 'petugas')  
          <a href="{{route('data.petugas')}}" class="btn-get-started scrollto" style="margin-left: 18px;"><button style="color: #fff">Lihat Data</button></a>   
      @endif

      @else
        <a href="{{route('login')}}" class="appointment-btn scrollto" style="margin-right: 18px; color:#fff">Login</a>
      @endif

    </div>
  </header><!-- End Header --

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="margin-bottom: 20px">
    <div class="container">
      <h1>Welcome to Medilab</h1>
      <h2>We are team of talented designers making websites with Bootstrap</h2>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">
        <div style="margin-bottom: 35px">
            <h4 style="color: #9e2531">How to!</h4>
            <h2><b style="color: #6c0d17">Step to Register as a Donor</b></h2>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6"> 
            <div class="count-box">
              <i class="fas fa-user-md"></i>
              <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
              <p>Doctors</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="far fa-hospital"></i>
              <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
              <p>Departments</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-flask"></i>
              <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
              <p>Research Labs</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="fas fa-award"></i>
              <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
              <p>Awards</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="title">
          <h2><b style="color: #6c0d17">Register Donor</b></h2>
        </div>
      </div>
      <div class="container" style="justify-content: center">
        <div class="row mt-5" >
          <div class="col-lg-8 mt-5 mt-lg-0">

            @if ($errors->any())
              <ul style="width: 100%; background: red; padding: 10px">
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </ul>
              @endif
  
              @if (Session::get('success'))
              <div style="width: 100%; background: green; padding: 5px">
                  {{ Session::get('success') }}
              </div>
              @endif
  
            <form action="{{route('store')}}" method="post" role="form" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nama" required>
                </div>

                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>

                <div class="col-md-6 form-group">
                  <input type="text" name="umur" class="form-control" id="umur" placeholder="Umur" required>
                </div>

                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="bb" id="bb" placeholder="Berat Badan" required>
                </div>

                <div class="form-group mt-3">
                  <input type="number"class="form-control" name="no_telp" id="no_telp" placeholder="Phone Number" required>
                </div>

                <div class="form-group mt-3">
                  <select name="donor" id="donor" class="form-control" >
                    <option selected hidden disabled>Pilih Golongan Darah Anda</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="O">O</option>
                    <option value="AB">AB</option>
                  </select>
                </div>

              <div class="form-group mt-3">
                <label for="">Scan your Card identity : </label>
                <input class="form-control" type="file" name="foto">
            </div>

              <div style="margin-top: 10pxx">
                <button type="submit" style="color: #fff">Send</button>
              </div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Medilab</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022
              United States <br>
              <br>
              <div class="social-links text-md-right pt-5 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Social Here</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{route('login')}}">Login</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Company</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Partners</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Investor</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">FAQ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright" style="color: #fff">
          &copy; Copyright <strong><span>Donor Darah</span></strong>. 2023
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>