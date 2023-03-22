<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ALUI is a highly creative, modern, visually stunning and Bootstrap v5.x responsive multipurpose Onepage HTML5 template.">
    <meta name="keywords" content="ALUI onepage, ALUI Admin template Creative Startup, modern, clean, bootstrap 5 responsive, portfolio, blog, templates, multipurpose, one page, corporate, start-up,">
    <title>Acharya E-Learning</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/css/al.style.min.css') }}" rel="stylesheet">
    
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/al.education.min.css') }}" rel="stylesheet">
</head>

<body>
  <div id="mainDiv" class="theme-orange">

    <!-- header top -->
    <div class="section header-top py-3 d-none d-sm-block">
        <div class="container">

            <div class="row align-items-center">
                <div class="col-auto d-none d-lg-block text-muted small">
                    <span><i class="fa fa-map-marker me-2"></i>Udiyankulangara, Trivandrum </span>
                </div>
                <div class="col-auto ms-md-auto order-md-2 d-none d-sm-block">
                    <ul class="list-unstyled d-flex mb-0">
                        <li><a class="text-muted ms-lg-4 ms-3" href="#!"><i class="fa fa-facebook-square"></i></a></li>
                        <li><a class="text-muted ms-lg-4 ms-3" href="#!"><i class="fa fa-github-square"></i></a></li>
                        <li><a class="text-muted ms-lg-4 ms-3" href="#!"><i class="fa fa-linkedin-square"></i></a></li>
                        <li><a class="text-muted ms-lg-4 ms-3" href="#!"><i class="fa fa-pinterest-square"></i></a></li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a class="text-muted small" href="mailto:admin@acharyaedu.in"><i class="fa fa-envelope me-2"></i>admin@acharyaedu.in</a>
                </div>
                <div class="col-auto">
                    <a class="text-muted small" href="callto:+919497273727"><i class="fa fa-mobile me-2"></i>+91 9497273727</a>
                </div>
            </div>

        </div>
    </div>

    <!-- header & hero img -->
    <div class="section header">

        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container">
                <a class="navbar-brand p-0 m-0" href="/"><span class="fs-2 fw-bold">ACHARYA</span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainnavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse fs-6" id="mainnavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item me-3"><a class="nav-link" aria-current="page" href="#">Home</a></li>
                        <li class="nav-item me-3 dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Courses</a>
                            <div class="dropdown-menu border-0 shadow dropdown-menu-end p-0">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">PSC Coaching</h6>
                                        </div>
                                        <p class="mb-1 text-muted small">LP/UP, Police, etc..</p>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item me-3 dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Student</a>
                            <div class="dropdown-menu border-0 shadow dropdown-menu-end p-0">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Register</h6>
                                        </div>
                                        <p class="mb-1 text-muted small">Register as a student</p>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Sign In</h6>
                                        </div>
                                        <p class="mb-1 text-muted small">Sign In as a Student</p>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <a href="/login" class="btn px-4 rounded-pill btn-primary">Admin</a>
                </div>
            </div>
        </nav>
        <div class="banner-text">
            <div class="container">

                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-xl-6 col-lg-7 col-md-12">
                        <h4>Become Master</h4>
                        <h2 class="bg-text color-900">A better <span class="text-gradient fw-bold">learning</span> future starts here</h2>
                        <p class="color-500 lead mb-4">Build a beautiful, modern website with flexible Bootstrap components built from scratch.</p>
                        <a href="/register" class="btn px-4 py-3 lift btn-primary text-uppercase rounded-pill">Register</a>
                        <a href="/login" class="btn px-4 py-3 lift btn-dark text-uppercase rounded-pill">Sign In</a>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12">
                        <img class="img-fluid" src="{{ asset('assets/images/education/hero.svg') }}" alt="hero img" />
                    </div>
                </div><!-- .row end -->

            </div>
        </div>

    </div>
    
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fa fa-arrow-up"></i></a>    

  </div>

  <!-- Bootstrap JS Files -->
  <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/bundles/tinyslider.bundle.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/setting.js') }}"></script>
</body>
</html>