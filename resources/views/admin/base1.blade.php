<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Acharya">
    <meta name="keywords" content="Acharya">
    <title>Acharya E-Learning</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
     
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/css/al.style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugin/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugin/smart-wizard/css/demo.css') }}" rel="stylesheet">
    
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
                <a class="navbar-brand p-0 m-0" href="/admin/dash"><img src="{{ asset('assets/images/logo/acharya-black.png') }}" class="img-fluid" width="25%" alt="Acharya"/></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainnavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse fs-6" id="mainnavbar">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item me-3 dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Exam</a>
                            <div class="dropdown-menu border-0 shadow dropdown-menu-end p-0">
                                <div class="list-group list-group-flush">
                                    <a href="/admin/subject" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Subject Register</h6>
                                        </div>
                                    </a>
                                    <a href="/admin/level" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Subject Level Register</h6>
                                        </div>
                                    </a>
                                    <a href="/admin/topic" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Module Register</h6>
                                        </div>
                                    </a>
                                    <a href="/admin/question" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Question Register</h6>
                                        </div>
                                    </a>
                                    <a href="/admin/exam" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Exam Register</h6>
                                        </div>
                                    </a>
                                    <a href="/admin/eq" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Exam Questions</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>                        
                        <li class="nav-item me-3 dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Reports</a>
                            <div class="dropdown-menu border-0 shadow dropdown-menu-end p-0">
                                <div class="list-group list-group-flush">
                                    <a href="/admin/student/performance" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Student Performance</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item me-3 dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Admin</a>
                            <div class="dropdown-menu border-0 shadow dropdown-menu-end p-0">
                                <div class="list-group list-group-flush">
                                    <a href="/logout" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 color-900">Logout</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @yield("content")
    </div>
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fa fa-arrow-up"></i></a>    

  </div>

  <!-- Bootstrap JS Files -->
  <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
  <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>

  <!-- Vendor JS Files -->
  <!--<script src="{{ asset('assets/bundles/tinyslider.bundle.js') }}"></script>-->

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/setting.js') }}"></script>
  <script src="{{ asset('assets/bundles/select2.bundle.js') }}"></script>
  <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
  <script src="{{ asset('assets/plugin/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
  <script src="{{ asset('assets/plugin/smart-wizard/js/demo.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
  <script src="{{ asset('assets/js/chart.js') }}"></script>
  @if(Route::current()->getName() == 'question.create' || Route::current()->getName() == 'question.edit')
  <script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('question', {
        toolbarCanCollapse : true,
    });
    CKEDITOR.replace('option1', {
        toolbarCanCollapse : true,
    });
    CKEDITOR.replace('option2', {
        toolbarCanCollapse : true,
    });
    CKEDITOR.replace('option3', {
        toolbarCanCollapse : true,
    });
    CKEDITOR.replace('option4', {
        toolbarCanCollapse : true,
    });
    CKEDITOR.replace('explanation', {
        toolbarCanCollapse : true,
    });
  </script>
  @endif
</body>
</html>