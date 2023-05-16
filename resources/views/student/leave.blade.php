@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
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
                <div class="row">
                    <div class="col-md-12"><h5 class="text-primary">{{ $student->name }}'s Leave Update</h5></div>
                </div>
                <div class="row">
                    <div class="col-6">
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
                                    <button type="submit" class="rts-btn btn-primary btn-submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection