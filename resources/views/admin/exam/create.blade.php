@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Create Exam</h5></div>
                    </div>
                    <form method="post" action="{{ route('exam.save') }}">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="req mb-1">Exam Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Exam Name">                                    
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-5">
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
                                    <label class="req mb-1">Cutoff Mark</label>
                                    <input type="number" class="form-control" name="cut_off_mark" value="{{ old('cut_off_mark') }}" placeholder="0">                                    
                                </div>
                                @error('cut_off_mark')
                                    <small class="text-danger">{{ $errors->first('cut_off_mark') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="req mb-1">Questions Count</label>
                                    <input type="number" class="form-control" name="question_count" value="{{ old('question_count') }}" placeholder="0">                                    
                                </div>
                                @error('question_count')
                                    <small class="text-danger">{{ $errors->first('question_count') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="req mb-1">Exam Duration (In Minutes)</label>
                                    <input type="number" class="form-control" name="duration" value="{{ old('duration') }}" placeholder="0">                                    
                                </div>
                                @error('duration')
                                    <small class="text-danger">{{ $errors->first('duration') }}</small>
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
                                    <label class="req mb-1">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Select</option>
                                        <option value="1" {{ (old('status') == 1) ? 'selected' : '' }}>Publish</option>
                                        <option value="0" {{ (old('status') == 0) ? 'selected' : '' }}>Draft</option>
                                    </select>                                  
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3 text-end">
                                <button type="submit" class="btn btn-submit btn-primary text-uppercase fs-6">Save</button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection