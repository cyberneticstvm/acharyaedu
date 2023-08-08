@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Revision</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('revision.update', $revision->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Title</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="title" value="{{ $revision->title }}" placeholder="Title">
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req mb-1">Batch</label>
                                <select class="form-control select2" name="batch_id" multiple>
                                    <option value="">Select</option>
                                    @forelse($batches as $key => $batch)
                                        <option value="{{ $batch->id }}" {{ ($revision->batch_id == $batch->id) ? 'selected' : '' }}>{{ $batch->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                            @error('batch_id')
                                <small class="text-danger">{{ $errors->first('batch_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req mb-1">Subject Name</label>
                                <select class="form-control subject" data-random="0" name="subject_id">
                                    <option value="">Select</option>
                                    @forelse($subjects as $key => $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                            @error('subject_id')
                                <small class="text-danger">{{ $errors->first('subject_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Module Name</label>
                                {!! Form::select('modules[]', $modules->pluck('name', 'id')->all(),  $revision->modules()->pluck('module_id')->toArray(), ['class' => 'form-control module select2', 'multiple']) !!}                                  
                            </div>
                            @error('modules')
                                <small class="text-danger">{{ $errors->first('modules') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select</option>
                                    <option value="1" {{ ($revision->status) == 1 ? 'selected' : '' }}>Completed</option>
                                    <option value="0" {{ ($revision->status) == 0 ? 'selected' : '' }}>Pending</option>
                                </select>                                  
                            </div>
                            @error('status')
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req mb-1">Revision Date</label>
                                <input type="date" class="form-control" name="date" value="{{ $revision->date->format('Y-m-d') }}">                                    
                            </div>
                            @error('date')
                                <small class="text-danger">{{ $errors->first('date') }}</small>
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