@extends("base")
@section("content")
<div class="banner-text">
    <div class="container">

        <div class="row g-3 justify-content-between align-items-center">
            <div class="col-xl-6 col-lg-7 col-md-12">
                <!--<h4>Become Master</h4>
                <h2 class="bg-text color-900">A better <span class="text-gradient fw-bold">learning</span> future starts here</h2>-->
                <div class="text-center"><img src="{{ asset('assets/images/logo/acharya-blue.png') }}" class="img-fluid" alt="Acharya"/></div>
                <!--<p class="color-500 lead mb-4">Build a better and beautiful career with Acharya Educations by learning from our industry expert faculties.</p>-->
                <a href="/register" class="btn px-4 py-3 lift btn-primary text-uppercase rounded-pill">Register</a>
                <a href="/signin" class="btn px-4 py-3 lift btn-dark text-uppercase rounded-pill">Sign In</a>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-12">
                <img class="img-fluid" src="{{ asset('assets/images/education/hero.svg') }}" alt="hero img" />
            </div>
        </div><!-- .row end -->

    </div>
</div>
@endsection