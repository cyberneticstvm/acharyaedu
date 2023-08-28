<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Acharya">
    <meta name="keywords" content="Acharya">
    <title>Acharya E-Learning</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon"> <!-- Favicon-->

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
    <!-- main css -->
    @if(Route::current()->getName() == 'onam2023gal')
    <link rel="stylesheet" href="{{ asset('assets/plugin/magnific-popup/magnific-popup.css') }}">
    @endif
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
                            <img src="{{ asset('assets/images/logo/logo-small.png') }}" alt="image-logo">
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
                                        <li class="menu-item">
                                            <a class="nav-item" href="/">Home</a>
                                        </li>
                                        <li class="menu-item">
                                            <a class="nav-item" href="/">About</a>
                                        </li>
                                        <li class="has-droupdown pages">
                                            <a class="nav-link" href="#">Gallery</a>
                                            <ul class="submenu inner-page">
                                                <li><a href="/onam-celeb-2023-video">Onam Celebration 2023 (Video)</a></li>
                                                <li><a href="/onam-celeb-2023-gallery">Onam Celebration 2023 (Gallery)</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-droupdown pages">
                                            <a class="nav-link" href="#">Courses</a>
                                            <ul class="submenu inner-page">
                                                @forelse(courseOffers() as $key => $course)
                                                    <li><a href="#">{{ $course->name }}</a></li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </li>                                        
                                        <li class="menu-item">
                                            <a class="nav-item" href="/">Blog</a>
                                        </li>
                                        <li class="menu-item">
                                            <a class="nav-item" href="/">Contact</a>
                                        </li>
                                        <li class="has-droupdown pages">
                                            <a class="nav-link" href="#">Student Zone</a>
                                            <ul class="submenu inner-page">
                                                @if(Auth::user())
                                                    <li><a href="/logout">Logout</a></li>
                                                @else
                                                    <li><a href="/signin">Signin</a></li>
                                                    <li><a href="/register">Register</a></li>
                                                @endif
                                            </ul>
                                        </li>                                        
                                    </ul>
                                </nav>
                            </div>
                            <!-- nav-area end -->
                            <!-- header style two End -->
                            <div class="right-area">
                                <a href="/register" class="rts-btn btn-seconday btn-transparent">Register Now! <i class="fa-solid fa-arrow-up-right"></i></a>
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
            <div class="inner-content">
                <h4 class="title">We Build Building and Great Constructive Homes.</h4>
                <p class="disc">
                    We successfully cope with tasks of varying complexity, provide long-term guarantees and regularly master new technologies.
                </p>
                <div class="footer">
                    <h4 class="title">Got a project in mind?</h4>
                    <a href="contact.html" class="rts-btn btn-seconday">Let's talk</a>
                </div>
            </div>
        </div>
        <!-- mobile menu area start -->
        <div class="mobile-menu d-block d-xl-none">
            <nav class="nav-main mainmenu-nav mt--30">
                <ul class="mainmenu" id="mobile-menu-active">
                    <li>
                        <a href="/" class="main">Home</a>
                    </li>
                    <li>
                        <a href="/" class="main">About</a>
                    </li>
                    <li class="has-droupdown">
                        <a class="main" href="#">Gallery</a>
                        <ul class="submenu">
                            <li><a class="mobile-menu-link" href="/onam-celeb-2023-video">Onam Celebration 2023 (Video)</a></li>
                            <li><a class="mobile-menu-link" href="/onam-celeb-2023-gallery">Onam Celebration 2023 (Gallery)</a></li>
                        </ul>
                    </li>                   
                    <li class="has-droupdown">
                        <a href="#" class="main">Courses</a>
                        <ul class="submenu">
                            @forelse(courseOffers() as $key => $course)
                                <li><a class="mobile-menu-link" href="#">{{ $course->name }}</a></li>
                            @empty
                            @endforelse                            
                        </ul>
                    </li>
                    <li>
                        <a href="/" class="main">Blog</a>
                    </li>
                    <li>
                        <a href="/" class="main">Contact</a>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Student Zone</a>
                        <ul class="submenu">
                            @if(Auth::user())
                                <li><a href="/logout">Logout</a></li>
                            @else
                                <li><a class="mobile-menu-link" href="/signin">Signin</a></li>
                                <li><a class="mobile-menu-link" href="/register">Register</a></li>
                            @endif                            
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="social-wrapper-one">
                <ul>
                    <li>
                        <a href="https://facebook.com/Acharyalearningplatform">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://youtube.com/@acharyaeducations">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://instagram.com/team_acharya_">
                            <i class="fa-brands fa-instagram"></i>
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
    <div class="rts-footer-two rts-section-gap2Top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- ,main footer area start -->
                    <div class="main-footer-wrapper-two">
                        <div class="single-footer-wized-two logo-area" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                            <a href="{{ asset('assets/images/logo/logo-small.png') }}" class="logo">
                                <img src="{{ asset('assets/images/logo/logo-small.png') }}" alt="logo">
                            </a>
                            <p class="disc-f">
                                Sapien luctus lesuada sentus pharetra nisi quisuea aenean eros mus magnis arcu vehicula nascetur feugiat
                            </p>
                            <div class="rts-social-wrapper-three">
                                <ul>
                                    <li><a href="https://facebook.com/Acharyalearningplatform" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href="https://youtube.com/@acharyaeducations" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href="https://instagram.com/team_acharya_" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-footer-wized-two pages" data-sal="slide-up" data-sal-delay="250" data-sal-duration="800">
                            <div class="footer-header-two pages">
                                <h6 class="title">Useful Links</h6>
                                <div class="pages">
                                    <ul>
                                        <li><a href="about.html"><i class="fa-solid fa-arrow-right"></i> About Us</a></li>
                                        <li><a href="project.html"><i class="fa-solid fa-arrow-right"></i> Our Projects</a></li>
                                        <li><a href="service.html"><i class="fa-solid fa-arrow-right"></i>Our Services</a></li>
                                        <li><a href="team.html"><i class="fa-solid fa-arrow-right"></i> Our Team</a></li>
                                        <li><a href="contact.html"><i class="fa-solid fa-arrow-right"></i> Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="single-footer-wized-two user-number" data-sal="slide-up" data-sal-delay="350" data-sal-duration="800">
                            <div class="user-number-wrapper mt--10">
                                <!-- single number -->
                                <div class="single-number">
                                    <h6 class="title">Phone Number</h6>
                                    <div class="number">
                                        <i class="fa-solid fa-phone"></i>
                                        <a href="tel:+919497273727">+91 9497273727</a>
                                    </div>
                                </div>
                                <!-- single number end -->
                                <!-- single number -->
                                <div class="single-number">
                                    <h6 class="title">Email address</h6>
                                    <div class="number">
                                        <i class="fa-light fa-envelope"></i>
                                        <a href="mailto:admin@acharyaedu.in">admin@acharyaedu.in</a>
                                    </div>
                                </div>
                                <!-- single number end -->
                                <!-- single number -->
                                <div class="single-number">
                                    <h6 class="title">Office Location</h6>
                                    <div class="number">
                                        <i class="fa-light fa-location-dot"></i>
                                        <a class="mt-dec" href="#">Udiyankulangara, Trivandrum</a>
                                    </div>
                                </div>
                                <!-- single number end -->
                            </div>
                        </div>
                        <div class="single-footer-wized-two newsletter" data-sal="slide-up" data-sal-delay="550" data-sal-duration="800">
                            <div class="footer-header-two newsletter">
                                <h6 class="title">Newsletter</h6>
                                <p class="letters">
                                    Aplications prodize before front end ortals visualize front end
                                </p>
                                <form class="subscribe-2-footer">
                                    <input type="text" required placeholder="Mobile Number" maxlength="10">
                                    <button class="rts-btn btn-primary">Request Callback</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ,main footer area end -->
                </div>
            </div>
        </div>
        <div class="menu-row-wrapper mt--80">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="menu-wrapper-footer-row">
                            <!-- single menu wrapper -->
                            <div class="single-menu" data-sal="zoom-in" data-sal-delay="150" data-sal-duration="800">
                                <a href="about.html">About Us</a>
                            </div>
                            <!-- single menu wrapper end -->
                            <!-- single menu wrapper -->
                            <div class="single-menu" data-sal="zoom-in" data-sal-delay="150" data-sal-duration="800">
                                <a href="project.html">Projects</a>
                            </div>
                            <!-- single menu wrapper end -->
                            <!-- single menu wrapper -->
                            <div class="single-menu" data-sal="zoom-in" data-sal-delay="150" data-sal-duration="800">
                                <a href="safety.html">Updates</a>
                            </div>
                            <!-- single menu wrapper end -->
                            <!-- single menu wrapper -->
                            <div class="single-menu" data-sal="zoom-in" data-sal-delay="150" data-sal-duration="800">
                                <a href="vision.html">Mission</a>
                            </div>
                            <!-- single menu wrapper end -->
                            <!-- single menu wrapper -->
                            <div class="single-menu" data-sal="zoom-in" data-sal-delay="150" data-sal-duration="800">
                                <a href="blog-list.html">Inside</a>
                            </div>
                            <!-- single menu wrapper end -->
                            <!-- single menu wrapper -->
                            <div class="single-menu" data-sal="zoom-in" data-sal-delay="150" data-sal-duration="800">
                                <a href="contact.html">Contact</a>
                            </div>
                            <!-- single menu wrapper end -->
                            <!-- single menu wrapper -->
                            <div class="single-menu" data-sal="zoom-in" data-sal-delay="150" data-sal-duration="800">
                                <a href="company-story.html">History</a>
                            </div>
                            <!-- single menu wrapper end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
    <!-- swip image -->
    <script src="{{ asset('assets/js/plugins/swip-img.js') }}"></script>
    <!-- header style two End -->
    @if(Route::current()->getName() == 'onam2023gal')
    <script src="{{ asset('assets/plugin/magnific-popup/jquery.magnific-popup.js') }}"></script>
    <script>
      $(document).ready(function() {
        $('.popup-img').magnificPopup({
          type: 'iframe'
        });
      });
    </script>
    @endif
    <script>
        $('form').submit(function(){
            $(".btn-submit").attr("disabled", true);
            $(".btn-submit").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span>");
        });
        setTimeout(function () {
            $(".alert").hide('slow');
        }, 5000);
    </script>
</body>
</html>