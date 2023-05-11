@extends("base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gap mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="title-mid-wrapper-home-two" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                    <span class="pre">Password</span>
                    <h2 class="title">Change Password</h2>
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
                <form class="contact-form-contact" method="post" action="{{ route('updatepassword') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    <input type="hidden" name="email" value="{{ $user->email }}" />
                    <div class="row">
                        <div class="col-md-4">
                            <input type="password" class="form-control form-control-sm" name="password" placeholder="******">
                            <label class="req">Password</label>
                            @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <input type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="******">
                            <label class="req">Confirm Password</label>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mt-3">
                            <a href="/signin">Signin</a>
                        </div>
                        <button type="submit" class="rts-btn btn-primary btn-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection