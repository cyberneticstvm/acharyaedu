@extends("base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gap mt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="title-mid-wrapper-home-two" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                    <span class="pre">Register</span>
                    <h2 class="title">Register yourself and access our free exams and more..</h2>
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
                <form class="contact-form-contact" method="post" action="{{ route('student.register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label class="req">Full Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}" placeholder="Full Name">                                
                            @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="req">Email ID</label>
                            <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}" placeholder="Email ID">                                
                            @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="req">Mobile Number</label>
                            <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{ old('mobile') }}" maxlength="10">                                
                            @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="req">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" value="{{ old('dob') }}">
                            @error('dob')
                                <small class="text-danger">{{ $errors->first('dob') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="req">Address</label>
                            <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}">                                
                            @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="req">Qualification</label>
                            <input type="text" class="form-control" placeholder="Qualification" name="qualification" value="{{ old('qualification') }}">                                
                            @error('qualification')
                                <small class="text-danger">{{ $errors->first('qualification') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="req">Password</label>
                            <input type="password" class="form-control" placeholder="******" name="password" >
                            @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="req">Confirm Password</label>
                            <input type="password" class="form-control" placeholder="******" name="password_confirmation" >
                            @error('password_confirmation')
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="rts-btn btn-primary btn-submit">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection