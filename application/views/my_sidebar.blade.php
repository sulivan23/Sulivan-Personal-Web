<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="{{ base_url() }}assets/img/favicon.png" rel="icon">
  <link href="{{ base_url() }}assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ base_url() }}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/font-awesome/css/font-awesome.css" rel="stylesheet"> 
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/konpa/devicon@master/devicon.min.css">

  <!-- Template Main CSS File -->
  <link href="{{ base_url() }}assets/css/style.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/pnotify/core/dist/Material.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/pnotify/core/dist/BrightTheme.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/pnotify/core/dist/Angeler.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/pnotify/core/dist/pnotify.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: iPortfolio - v1.4.0
  * Modified by : Irvan Sulistio
  * Template URL: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
  .particles-js-canvas-el{
    position:absolute;
  }

  .d-md-flex{
    padding-top:15px;
  }
</style>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="d-flex flex-column">

      <div class="profile">
        <img src="{{ base_url() }}assets/img/vaan.jpeg" alt="" style="height:120px;" class="img-fluid rounded-circle">
        <h1 class="text-light"><a href="{{ base_url() }}"><?= $my_name ?></a></h1>
        <div class="social-links mt-3 text-center">
          <a href="#" class="facebook"><i class="bx bxl-github"></i></a>
          <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
      </div>

      <nav class="nav-menu">
        <ul>
          <li class="active"><a href="{{ base_url() }}"><i class="bx bx-home"></i> <span>Home</span></a></li>
          <li><a href="#about"><i class="bx bx-user"></i> <span>About</span></a></li>
          <li><a href="#resume"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
          <li><a href="#portfolio"><i class="bx bx-book-content"></i> Portfolio</a></li>
          <li><a href="#contact"><i class="bx bx-envelope"></i> Contact</a></li>

        </ul>
      </nav><!-- .nav-menu -->
      <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

    </div>
  </header><!-- End Header -->
@yield('content')