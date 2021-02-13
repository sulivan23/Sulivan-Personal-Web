<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/node_modules/jqvmap/dist/jqvmap.min.css"> -->
  <!-- <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/node_modules/weathericons/css/weather-icons.min.css">
  <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/node_modules/weathericons/css/weather-icons-wind.min.css"> -->
  <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/node_modules/summernote/dist/summernote-bs4.css">
  <link href="{{ base_url() }}assets/vendor/pnotify/core/dist/Material.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/pnotify/core/dist/BrightTheme.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/pnotify/core/dist/Angeler.css" rel="stylesheet">
  <link href="{{ base_url() }}assets/vendor/pnotify/core/dist/pnotify.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ base_url() }}assets/vendor/magnific-popup/magnific-popup.css" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/assets/css/style.css">
  <link rel="stylesheet" href="{{ base_url() }}assets/css/custom.css">
  <link rel="stylesheet" href="{{ base_url() }}dashboard_assets/assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Histories
              </div>
              <div class="search-item">
                <a href="#">How to hack NASA using CSS</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">Kodinger.com</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">#Stisla</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-header">
                Result
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="{{ base_url() }}dashboard_assets/assets/img/products/product-3-50.png" alt="product">
                  oPhone S9 Limited Edition
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="{{ base_url() }}dashboard_assets/assets/img/products/product-2-50.png" alt="product">
                  Drone X2 New Gen-7
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="{{ base_url() }}dashboard_assets/assets/img/products/product-1-50.png" alt="product">
                  Headphone Blitz
                </a>
              </div>
              <div class="search-header">
                Projects
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-danger text-white mr-3">
                    <i class="fas fa-code"></i>
                  </div>
                  Stisla Admin Template
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fas fa-laptop"></i>
                  </div>
                  Create a new Homepage Design
                </a>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ base_url() }}dashboard_assets/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ $full_name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="features-profile.html" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="features-activities.html" class="dropdown-item has-icon">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ base_url().'dashboard' }}">{{ $title }}</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
              <li><a class="nav-link" href="{{ base_url("dashboard") }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
              <li class="menu-header">Portfolio Page</li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-home"></i> <span>Home</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="">Home</a></li>
                  <li><a class="nav-link" href="{{ base_url().'dashboard/configurable' }}">Configurable Data</a></li>
                  <li><a class="nav-link" href="{{ base_url().'dashboard/internship' }}">Internsip</a></li>
                  <li><a class="nav-link" href="{{ base_url().'dashboard/experience' }}">Experience</a></li>
                  <li><a class="nav-link" href="{{ base_url().'dashboard/skills' }}">Skills</a></li>
                </ul>
              </li>
              <li><a class="nav-link" href="{{ base_url().'dashboard/email' }}"><i class="fas fa-envelope"></i> <span>Email Settings</span></a></li>
              <li class="menu-header">Apps</li>
              <li><a class="nav-link" href="{{ base_url().'dashboard/apps' }}"><i class="fas fa-file-alt"></i> <span>Manage Apps</span></a></li>
              <li class="menu-header">Tasks</li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>My Task</span></a>
                <ul class="dropdown-menu">
                  <li><a href="auth-forgot-password.html">Job Task</a></li>
                  <li><a href="auth-login.html">Project</a></li>
                  <li><a href="auth-login-2.html">Scheduler Email</a></li>
                </ul>
              </li>
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="{{ base_url().'auth/logout' }}" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fa fa-sign-out-alt"></i> Logout
              </a>
            </div>
        </aside>
      </div>
      @yield('header')