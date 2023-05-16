@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Chapter</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('chapter.update', $chapter->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Level</label>
                                {!! Form::select('level_id', $levels, $chapter->level_id, array('placeholder' => 'Select','class' => 'form-control')) !!}                                   
                            </div>
                            @error('level_id')
                                <small class="text-danger">{{ $errors->first('level_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Subject</label>
                                {!! Form::select('subject_id', $subjects, $chapter->subject_id, array('placeholder' => 'Select','class' => 'form-control')) !!}                                   
                            </div>
                            @error('subject_id')
                                <small class="text-danger">{{ $errors->first('subject_id') }}</small>
                            @enderror
                        </div>                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Chapter Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $chapter->name }}" placeholder="Chapter Name">                                    
                            </div>
                            @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">UPDATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection