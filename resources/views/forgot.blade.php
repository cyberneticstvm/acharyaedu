@extends("base")
@section("content")
<div class="section how-it" id="Howitworks">
    <div class="container">
        <div class="row g-3 justify-content-between mb-3">
            <div class="col-lg-8 col-md-12">
                <div class="section-heading mb-4">
                    <span class="bg-dark px-2 py-1 color-fff">Forgot Password</span>
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
            <form method="post" action="{{ route('send.email') }}">
                @csrf
                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}" placeholder="Email ID">
                            <label class="req">Email ID</label>
                        </div>
                        @error('email')
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @enderror
                    </div>
                    <div class="col-12 mt-3">
                        <a href="/signin">Signin</a>
                    </div>
                    <div class="col-4 mt-3 text-end">
                        <button type="submit" class="btn btn-submit btn-primary text-uppercase fs-6 rounded-pill">Send Email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection