@extends("base")
@section("content")
<!-- contact form area strt -->
<div class="rts-contact-page-form-area rts-section-gap mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="title-mid-wrapper-home-two" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                    <span class="pre">Gallery</span>
                    <h2 class="title">Onam Celebration 2023</h2>
                </div>
                <div class="row">
                    @forelse($gals as $key => $gal)
                        <div class="col-md-3">
                            <a class="popupgal" href="{{ url('storage/'.$gal->attachment) }}"><img src="{{ url('storage/'.$gal->attachment) }}" alt="Onam2023" /></a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection