@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Offline Exam</h3>
            </div>
            <div class="card-body">
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
                <form role="form" method="post" action="{{ route('admin.offline.exam.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
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
                                <label class="req mb-1">Total Mark</label>
                                <input type="number" class="form-control" name="total_mark" value="{{ old('total_mark') }}" placeholder="0">
                            </div>
                            @error('total_mark')
                            <small class="text-danger">{{ $errors->first('total_mark') }}</small>
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