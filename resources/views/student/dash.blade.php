@extends("student.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">{{ Auth::user()->name }}'s Profile</h5></div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <form method="post" action="{{ route('student.profile.update') }}">
                                @csrf
                                @method("PUT")
                                <div class="row g-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="req mb-1">Full Name</label>
                                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">                                    
                                        </div>
                                        @error('name')
                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="req mb-1">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">                                    
                                        </div>
                                        @error('email')
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="req mb-1">Mobile</label>
                                            <input type="text" class="form-control" name="mobile" maxlength="10" value="{{ Auth::user()->mobile }}">                                    
                                        </div>
                                        @error('mobile')
                                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="mb-1">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="******">                                    
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 text-end">
                                        <button type="submit" class="btn btn-submit btn-primary text-uppercase fs-6">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">

                                </div>
                                <div class="col-6 text-center">
                                    @if(Auth::user()->student->photo != '')
                                        <img src="https://app.acharyaedu.in/public/storage/photos/{{ Auth::user()->student->photo }}" height="100%" width="50%" alt="{{ Auth::user()->student->name }}" />
                                    @else
                                        <img src="{{ asset('assets/images/avatar.webp') }}" width="120" height="120" alt="{{ Auth::user()->student->name }}" />
                                        <p class="text-center mt-1"><a href="">Upload Photo</a></p>
                                    @endif 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection