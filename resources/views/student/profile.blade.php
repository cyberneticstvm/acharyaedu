@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bolder text-primary text-gradient">Dashboard - Student</h3>
                        <h5 class="font-weight-bolder text-primary text-gradient">Student ID: {{ Auth::user()->student->id }}</h5>
                    </div>
                </div>
                @if(session()->has('success'))
                <div class="alert alert-success text-white">
                    {{ session()->get('success') }}
                </div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger text-white">
                    {{ session()->get('error') }}
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="req">Student Name</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Student Name" name="name" value="{{ Auth::user()->name }}" aria-label="Text" aria-describedby="text-addon">
                                    </div>
                                    @error('name')
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="req">Email ID</label>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email ID" name="email" value="{{ Auth::user()->email }}" aria-label="Email" aria-describedby="email-addon">
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="req">Mobile Number</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{ Auth::user()->mobile }}" maxlength="10" aria-label="Text" aria-describedby="text-addon">
                                    </div>
                                    @error('mobile')
                                        <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="req">Address</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{ Auth::user()->student->address }}" aria-label="Text" aria-describedby="text-addon">
                                    </div>
                                    @error('address')
                                        <small class="text-danger">{{ $errors->first('address') }}</small>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                     <div class="col-md-4">
                        @if(Auth::user()->student->photo)
                            <img src="{{ asset('storage/student-photos/'.Auth::user()->student->id.'/'.Auth::user()->student->photo) }}" height="100%" width="50%" class="img-fluid" alt="{{ Auth::user()->student->name }}" />
                        @else
                            <img src="{{ asset('assets/images/avatar.webp') }}" width="120" height="120" alt="{{ Auth::user()->student->name }}" />
                            <form method="post" class="mt-3" action="{{ route('student.photo.upload') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="file" class="" name="photo" required />
                                        @error('photo')
                                            <small class="text-danger">{{ $errors->first('photo') }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                        <div class="mt-5">
                            <h5>Payment QR Code</h5>
                            <img src="{{ asset('assets/images/qr.png') }}" width="250" height="250" alt="QR" />
                            <p>OR ENTER PAYMENT ADDRESS<br><strong>saijusss0951@dlb</strong></p>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection