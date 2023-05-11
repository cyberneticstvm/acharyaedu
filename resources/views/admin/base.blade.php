<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin-assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    Acharya Educations
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('admin-assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin-assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('admin-assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('admin-assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link id="pagestyle" href="{{ asset('admin-assets/css/style.css') }}" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/plugin/smart-wizard/css/smart_wizard_all.min.css') }}">
</head>

<body class="g-sidenav-show  bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 ps--active-y" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/dash">
        <img src="{{ asset('admin-assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Acharya Edu.</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('dash') }}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>shop </title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(0.000000, 148.000000)">
                        <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                        <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#admins" aria-controls="admins" role="button" aria-expanded="false" data-bs-toggle="collapse">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Administration</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g id="office" transform="translate(153.000000, 2.000000)">
                        <path class="color-background opacity-6" d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"></path>
                        <path class="color-background" d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Administration</span>
          </a>
          <div class="collapse" id="admins">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a class="nav-link text-white " href="/user">
                  <i class='fa fa-users sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Staff</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/branch">
                  <i class="fa fa-code-fork sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Branch</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/student">
                  <i class="fa fa-graduation-cap sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Student</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/course">
                  <i class="fa fa-id-card-o sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Course</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/syllabus">
                  <i class="fa fa-file sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Syllabus</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/batch">
                  <i class="fa fa-bars sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Batch</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/student-batch">
                  <i class="fa fa-arrows-h sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Student => Batch</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/syllabus-status">
                  <i class="fa fa-check sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Syllabus Status</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/fee">
                  <i class="fa fa-dollar sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Fee</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/attendance">
                  <i class="fa fa-calendar sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Attendance</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/head">
                  <i class="fa fa-header sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">I/E Heads</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/income">
                  <i class="fa fa-money sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Income</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/expense">
                  <i class="fa fa-shopping-cart sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Expense</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#exam" aria-controls="exam" role="button" aria-expanded="false" data-bs-toggle="collapse">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Opticals</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(453.000000, 454.000000)">
                        <path class="color-background opacity-6" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"></path>
                        <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Exam Management</span>
          </a>
          <div class="collapse" id="exam">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a class="nav-link text-white " href="/admin/subject">
                  <i class='fa fa-book sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Subject Register</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/admin/level">
                  <i class='fa fa-bars sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Subject Level Register</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/admin/topic">
                  <i class='fa fa-bookmark sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Module Register</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/admin/question">
                  <i class='fa fa-quora sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Question Register</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/admin/exam">
                  <i class='fa fa-file-text-o sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Exam Register</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/admin/eq">
                  <i class='fa fa-file-code-o sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Exam questions Register</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#settings" aria-controls="settings" role="button" aria-expanded="false" data-bs-toggle="collapse">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>settings</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(304.000000, 151.000000)">
                        <polygon class="color-background opacity-6" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                        <path class="color-background opacity-6" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"></path>
                        <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Settings</span>
          </a>
          <div class="collapse" id="settings">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a class="nav-link text-white " href="/settings">
                  <i class='fa fa-gear sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Settings</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#opt" aria-controls="opt" role="button" aria-expanded="false" data-bs-toggle="collapse">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>Opticals</title>
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <g transform="translate(1716.000000, 291.000000)">
                      <g transform="translate(453.000000, 454.000000)">
                        <path class="color-background opacity-6" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z"></path>
                        <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                      </g>
                    </g>
                  </g>
                </g>
              </svg>
            </div>
            <span class="nav-link-text ms-1">Reports</span>
          </a>
          <div class="collapse" id="opt">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a class="nav-link text-white " href="/report/daybook">
                  <i class='fa fa-file sidenav-mini-icon'></i>
                  <span class="sidenav-normal ms-2 ps-1">Daybook</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/report/attendance">
                  <i class="fa fa-calendar sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Attendance</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/report/attendance/summary">
                  <i class="fa fa-calendar sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Attendance Summary</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/report/fee">
                  <i class="fa fa-money sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Fee</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/report/fee-pending">
                  <i class="fa fa-money sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Fee Pending</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/report/student">
                  <i class="fa fa-user sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Student</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/report/ie">
                  <i class="fa fa-file sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Income / Expense</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white " href="/admin/student/performance">
                  <i class="fa fa-line-chart sidenav-mini-icon"></i>
                  <span class="sidenav-normal ms-2 ps-1">Exam Performance</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
      <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none ">
          <a href="javascript:;" class="nav-link text-body p-0">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </div>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="/logout" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-power-off me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign Out</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @yield("content")
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                by
                <a href="https://www.acharyaedu.in" class="font-weight-bold" target="_blank">Acharya Edu.</a>
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.cybernetics.me" class="nav-link text-muted" target="_blank">Cybernetics</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('admin-assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  @if(Route::current()->getName() == 'admin.exam.performance')
  <script src="{{ asset('admin-assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/acharya-charts.js') }}"></script>
  @endif
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('admin-assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="{{ asset('assets/plugin/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
  <script src="{{ asset('admin-assets/js/script.js') }}"></script>
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