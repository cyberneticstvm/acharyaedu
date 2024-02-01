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
                        @php $student = App\Models\Student::find(Auth::id()) @endphp
                        <h5 class="font-weight-bolder text-primary text-gradient">Batches: {{ Batch::whereIn('id', $student->batches()->pluck('batch'))->pluck('name')->implode(', ') }}</h5>
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
                    <div class="col-md-12">
                        <div class="card z-index-2">
                            <p class="fw-bold">"Dream is not that which you see while sleeping, it is something that does not let you sleep" Dr. APJ Abdul Kalam</p>
                        </div>
                    </div>
                    <div class="col-md-4 mt-5 text-center">
                        <h4>Become Master</h4>
                        <h2 class="bg-text color-900">A better <span class="fw-bold">learning</span> future starts here</h2>
                        <p class="color-500 lead mb-4">When You do Something Patiently Everyday, Eventually You Will Become the Master of It.</p>
                    </div>
                    <div class="col-md-8 text-center">
                        <img src="{{ asset('assets/images/hero.svg') }}" class="img-fluid" width="50%" />
                    </div>
                    <!-- <div class="col-md-4">
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
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection