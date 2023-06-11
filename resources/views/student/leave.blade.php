@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">{{ $student->name }}'s Leave Update</h3></div>
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
                <form method="post" action="{{ route('student.leave.update') }}">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Batch Name</label>
                                {!! Form::select('batch', $batches, null, array('placeholder' => 'Select','class' => 'form-control')) !!}                                    
                            </div>
                            @error('batch')
                                <small class="text-danger">{{ $errors->first('batch') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req">Reason</label>
                                <input type="text" class="form-control" name="reason" value="{{ old('reason') }}" placeholder="Reason">                                    
                            </div>
                            @error('reason')
                                <small class="text-danger">{{ $errors->first('reason') }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection