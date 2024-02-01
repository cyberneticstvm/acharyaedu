@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Exam Settings</h3>
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
                <form method="post" action="{{ route('admin.exam.setting.update', $etype->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Exam Type</label>
                                <select class="form-control" name="exam_type">
                                    <option value="{{ $etype->id }}">{{ $etype->name }}</option>
                                </select>
                            </div>
                            @error('exam_type')
                            <small class="text-danger">{{ $errors->first('exam_type') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="req mb-1">Batch</label>
                                <select class="form-control" name="batch_id">
                                    <option value="">Select</option>
                                    @forelse($batches as $key => $batch)
                                    <option value="{{ $batch->id }}" {{ ($etype->batch_id == $batch->id) ? 'selected' : '' }}>{{ $batch->name }}</option>
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
                                <input type="number" class="form-control" name="cut_off_mark" value="{{ $etype->cut_off_mark }}" placeholder="0">
                            </div>
                            @error('cut_off_mark')
                            <small class="text-danger">{{ $errors->first('cut_off_mark') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req mb-1">Questions Count</label>
                                <input type="number" class="form-control" name="question_count" value="{{ $etype->question_count }}" placeholder="0">
                            </div>
                            @error('question_count')
                            <small class="text-danger">{{ $errors->first('question_count') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req mb-1">Exam Duration (In Minutes)</label>
                                <input type="number" class="form-control" name="duration" value="{{ $etype->exam_duration }}" placeholder="0">
                            </div>
                            @error('duration')
                            <small class="text-danger">{{ $errors->first('duration') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req mb-1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select</option>
                                    <option value="Active" {{ ($etype->status == 'Active') ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ ($etype->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            @error('status')
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">UPDATE</button>
                            <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection