@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Update Exam</h5></div>
                    </div>
                    <form method="post" action="{{ route('exam.update', $exam->id) }}">
                        @csrf
                        @method("PUT")
                        <div class="row g-2">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="req mb-1">Exam Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $exam->name }}" placeholder="Exam Name">                                    
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
                                            <option value="{{ $batch->id }}" {{ ($exam->batch_id == $batch->id) ? 'selected' : '' }}>{{ $batch->name }}</option>
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
                                    <input type="number" class="form-control" name="cut_off_mark" value="{{ $exam->cut_off_mark }}" placeholder="0">                                    
                                </div>
                                @error('cut_off_mark')
                                    <small class="text-danger">{{ $errors->first('cut_off_mark') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="req mb-1">Questions Count</label>
                                    <input type="number" class="form-control" name="question_count" value="{{ $exam->question_count }}" placeholder="0">                                    
                                </div>
                                @error('question_count')
                                    <small class="text-danger">{{ $errors->first('question_count') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="req mb-1">Exam Date</label>
                                    <input type="date" class="form-control" name="exam_date" value="{{ $exam->exam_date->format('Y-m-d') }}">                                    
                                </div>
                                @error('exam_date')
                                    <small class="text-danger">{{ $errors->first('exam_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3 text-end">
                                <button type="submit" class="btn btn-submit btn-primary text-uppercase fs-6">Update</button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection