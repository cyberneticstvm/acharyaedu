@extends("base")
@section("content")
<div class="section how-it" id="Howitworks">
    <div class="container">
        <div class="row g-3 justify-content-between mb-3">
            <div class="col-lg-8 col-md-12">
                <div class="section-heading mb-4">
                    <span class="bg-dark px-2 py-1 color-fff">Student Registration</span>
                    <h2 class="h1 fw-bold mt-3 color-900">Student Registration</h2>
                    <p class="lead">Register yourself and access our free question banks and more..</p>
                </div>
            </div>
        </div>
        <div class="row">
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
            <form method="post" action="{{ route('student.save') }}">
                @csrf
                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}" placeholder="Full Name">
                            <label class="req">Full Name</label>
                        </div>
                        @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}" placeholder="Email ID">
                            <label class="req">Email ID</label>
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{ old('mobile') }}" maxlength="10">
                            <label class="req">Mobile Number</label>
                        </div>
                        @error('mobile')
                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="date" class="form-control" name="dob" value="{{ old('dob') }}">
                            <label class="req">Date of Birth</label>
                        </div>
                        @error('dob')
                            <small class="text-danger">{{ $errors->first('dob') }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}">
                            <label class="req">Address</label>
                        </div>
                        @error('address')
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Qualification" name="qualification" value="{{ old('qualification') }}">
                            <label class="req">Qualification</label>
                        </div>
                        @error('qualification')
                            <small class="text-danger">{{ $errors->first('qualification') }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="password" class="form-control" placeholder="******" name="password" >
                            <label class="req">Password</label>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="password" class="form-control" placeholder="******" name="password_confirmation" >
                            <label class="req">Confirm Password</label>
                        </div>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                        @enderror
                    </div>
                    <div class="col-12 mt-3 text-end">
                        <button type="submit" class="btn btn-lg btn-submit btn-primary text-uppercase fs-6 rounded-pill">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection