@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Exam Performance</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('oep.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req mb-1">Student ID</label>
                                <input type="number" class="form-control" name="student_id" value="{{ old('student_id') }}" placeholder="0">                                    
                            </div>
                            @error('student_id')
                                <small class="text-danger">{{ $errors->first('student_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req mb-1">Exam Name</label>
                                <input type="text" class="form-control" name="exam_name" value="{{ old('exam_name') }}" placeholder="Exam Name">                                    
                            </div>
                            @error('exam_name')
                                <small class="text-danger">{{ $errors->first('exam_name') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req mb-1">Batch</label>
                                <select class="form-control" name="batch_id">
                                    <option value="">Select</option>
                                    @forelse($batches as $key => $batch)
                                        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                            @error('batch_id')
                                <small class="text-danger">{{ $errors->first('batch_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req mb-1">Exam Date</label>
                                <input type="date" class="form-control" name="exam_date" value="{{ old('exam_date') }}">                                    
                            </div>
                            @error('exam_date')
                                <small class="text-danger">{{ $errors->first('exam_date') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req mb-1">Total Mark</label>
                                <input type="number" class="form-control" name="total_mark" value="{{ old('total_mark') }}" placeholder="0">                                    
                            </div>
                            @error('total_mark')
                                <small class="text-danger">{{ $errors->first('total_mark') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req mb-1">Mark Scored</label>
                                <input type="number" class="form-control" name="mark_scored" value="{{ old('mark_scored') }}" placeholder="0">                                    
                            </div>
                            @error('total_mark')
                                <small class="text-danger">{{ $errors->first('total_mark') }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">CREATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection