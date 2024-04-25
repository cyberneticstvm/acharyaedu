@extends("base")
@section("content")
<!-- contact form area strt -->
<div class="rts-contact-page-form-area rts-section-gap mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="title-mid-wrapper-home-two" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                    <span class="pre">Signin</span>
                    <h2 class="title">Sign in and explore our portal</h2>
                </div>
                <div id="form-messages">
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
                <form class="contact-form-contact" method="post" action="{{ route('signin') }}">
                    @csrf
                    <input type="hidden" name="status" value="active" />
                    <div class="row">
                        <div class="col-md-6">
                            <label class="req">Email ID</label>
                            <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}" placeholder="Email ID">
                            @error('email')
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="req">Password</label>
                            <input type="password" class="form-control form-control-sm" placeholder="******" name="password">
                            @error('password')
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mt-3">
                            <a href="/forgot">Forgot Password?</a>
                        </div>
                        <button type="submit" class="rts-btn btn-primary btn-submit">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection