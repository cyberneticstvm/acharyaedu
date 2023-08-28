@extends("base")
@section("content")
<!-- contact form area strt -->
<div class="rts-contact-page-form-area rts-section-gap mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="title-mid-wrapper-home-two" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                    <span class="pre">Video</span>
                    <h2 class="title">Onam Celebration 2023</h2>
                </div>
                <video width="320" height="240" controls>
                    <source src="{{ asset('storage/ceremony/Acharya_Onam_Celebration_2023.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>
@endsection