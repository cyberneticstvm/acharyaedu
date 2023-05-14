<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Acharya">
    <meta name="keywords" content="Acharya">
    <title>Acharya E-Learning</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon"> <!-- Favicon-->

     <!-- fontawesome css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/fontawesome-5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/unicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/metismenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/hover-revel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/timepickers.min.css') }}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/smart-wizard/css/smart_wizard_all.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/acharya.css') }}">
</head>

<body class="home-one">
  <!-- header area start -->
  <header class="heder-two header-six header--sticky">
    <div class="header-two-container">
        <div class="row">
            <div class="col-12">
                <div class="header-main-wrapper">
                    <div class="logo-area">
                        <a href="/" class="logo">
                            <img src="{{ asset('assets/images/logo/acharya-white-small.png') }}" alt="image-logo">
                        </a>
                    </div>
                    <!-- header right start -->
                    <div class="rts-header-right">
                        <div class="menu-area" id="menu-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
                                <rect width="18" height="2" fill="#0C0A0A" />
                                <rect y="7" width="18" height="2" fill="#0C0A0A" />
                                <rect y="14" width="18" height="2" fill="#0C0A0A" />
                            </svg>
                        </div>
                        <!-- top header -->
                        <div class="top">
                            <div class="start-top">
                                <div class="icon"><i class="fa-sharp fa-solid fa-bolt"></i></div>
                                <p>Your choice decides your destiny!</p>
                            </div>
                            <div class="end-top">
                                <div class="single-info">
                                    <div class="icon"><i class="fa-thin fa-location-dot"></i> </div>
                                    <p>Udiyankulangara, Trivandrum</p>
                                </div>
                                <div class="single-info">
                                    <div class="icon"><i class="fa-regular fa-envelope"></i></div>
                                    <a href="mailto:admin@acharyaedu.in">admin@acharyaedu.in</a>
                                </div>
                            </div>
                        </div>
                        <!-- top header end -->
                        <!-- bottom header start -->
                        <div class="bottom">
                            <!-- header style two -->
                            <!-- nav area start -->
                            <div class="main-nav-desk nav-area">
                                <nav>
                                    <ul>
                                        <li class="has-droupdown pages">
                                            <a class="nav-link" href="#">Student Zone</a>
                                            <ul class="submenu inner-page">
                                                <li><a href="/student/dash">Profile</a></li>
                                                <li><a href="/student/active-exams">Active Exams</a></li>
                                                <li><a href="/student/performance">My Performance</a></li>
                                                <li><a href="/student/freeexam">Free Exam</a></li>
                                                <li><a href="/logout">Logout</a></li>
                                            </ul>
                                        </li>                                      
                                    </ul>
                                </nav>
                            </div>
                            <!-- nav-area end -->
                            <!-- header style two End -->
                            <div class="right-area">
                                <a href="/logout" class="rts-btn btn-seconday btn-transparent">Logout <i class="fa-solid fa-power-off"></i></a>
                            </div>
                        </div>
                        <!-- bottom header end -->
                    </div>
                    <!-- header right end -->
                </div>
            </div>
        </div>
    </div>
  </header>
<!-- header area end -->
<!-- side bar for desktop -->
<div id="side-bar" class="side-bar header-two">
    <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- inner menu area desktop start -->
        <div class="inner-main-wrapper-desk">
            <div class="thumbnail">
                <img src="{{ asset('assets/images/logo/d.png') }}" alt="Acharya">
            </div>
        </div>
        <!-- mobile menu area start -->
        <div class="mobile-menu d-block d-xl-none">
            <nav class="nav-main mainmenu-nav mt--30">
                <ul class="mainmenu" id="mobile-menu-active">
                    <li class="has-droupdown">
                        <a href="#" class="main">Student Zone</a>
                        <ul class="submenu">
                            <li><a class="mobile-menu-link" href="/student/dash">Profile</a></li>
                            <li><a class="mobile-menu-link" href="/student/active-exams">Active Exams</a></li>
                            <li><a class="mobile-menu-link" href="/student/performance">My Performance</a></li>
                            <li><a class="mobile-menu-link" href="/student/studymaterials">Free Exam</a></li>
                            <li><a class="mobile-menu-link" href="/logout">Logout</a></li>                           
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="social-wrapper-one">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- mobile menu area end -->
    </div>
    <!-- header style two End -->

    @yield("content")

    <!-- Footer two -->
    <!-- rts footer area start -->
    <div class="rts-footer-two">
        <!-- copy right area start -->
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-footer-two">
                            <p class="disc">
                                © {{ date('Y') }} Acharya Educations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- copyright area end -->
    </div>
    <!-- rts footer area end -->
    <!-- Footer two End -->

    <!-- progress area start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>
    <!-- progress area end -->
    <div id="anywhere-home" class="">
    </div>

    <!-- pre loader start -->
    <div id="elevate-load">
        <div class="loader-wrapper">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- pre loader end -->

    <!-- jquery js -->
  <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <!-- jquery ui -->
    <script src="{{ asset('assets/js/vendor/jqueryui.js') }}"></script>
    <!-- counter up -->
    <script src="{{ asset('assets/js/plugins/counter-up.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper.js') }}"></script>
    <!-- twinmax -->
    <script src="{{ asset('assets/js/vendor/twinmax.js') }}"></script>
    <!-- split text js -->
    <script src="{{ asset('assets/js/vendor/split-text.js') }}"></script>
    <!-- text plugins -->
    <script src="{{ asset('assets/js/plugins/text-plugins.js') }}"></script>
    <!-- metismenu js -->
    <script src="{{ asset('assets/js/plugins/metismenu.js') }}"></script>
    <!-- waypoint js -->
    <script src="{{ asset('assets/js/vendor/waypoint.js') }}"></script>
    <!-- waw -->
    <script src="{{ asset('assets/js/vendor/waw.js') }}"></script>
    <!-- aos js -->
    <script src="{{ asset('assets/js/plugins/aos.js') }}"></script>
    <!-- jquery ui js -->
    <script src="{{ asset('assets/js/plugins/jquery-ui.js') }}"></script>
    <!-- timepickers -->
    <script src="{{ asset('assets/js/plugins/jquery-timepicker.js') }}"></script>
    <!-- sal animation -->
    <script src="{{ asset('assets/js/vendor/sal.min.js') }}"></script>
    <!-- bootstrap JS -->
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <!-- easing JS -->
    <script src="{{ asset('assets/js/plugins/jquery-slideNav.js') }}"></script>
    <!-- easing JS -->
    <script src="{{ asset('assets/js/plugins/hover-revel.js') }}"></script>
    <!-- contact form js -->
    <script src="{{ asset('assets/js/plugins/contact-form.js') }}"></script>
    <!-- main js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/bundles/select2.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    
    
    <script src="{{ asset('assets/plugin/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @if(Route::current()->getName() == 'student.exam')
    <script>
        var timeleft = parseInt($("#exam-time-duration").val()); 
        var s = 60;
        var examTimerSecs = setInterval(function(){
            if(s <= 0){
                s = 60;
                timeleft -= 1;
                document.getElementById("time-remain").innerHTML = timeleft;
            }
            if(timeleft <= 0){
                clearInterval(examTimerSecs);
                alert("Your time has over.");
                $("#frmExam").submit();
            }
            document.getElementById("secs").innerHTML = s;
            s -= 1;
        }, 1000);
    </script>
    @endif
    @if(Route::current()->getName() == 'student.exam.performance' || Route::current()->getName() == 'student.performance')
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    @endif
    <!-- swip image -->
    <script src="{{ asset('assets/js/plugins/swip-img.js') }}"></script>
    <!-- header style two End -->
</body>
</html>