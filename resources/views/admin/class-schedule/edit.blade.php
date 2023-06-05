@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Scheduled Class</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('cschedule.update', $class->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Class Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="class_date" value="{{ $class->class_date->format('Y-m-d') }}" aria-label="Text" aria-describedby="text-addon" placeholder="Date">
                                </div>
                                @error('class_date')
                                    <small class="text-danger">{{ $errors->first('class_date') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Batch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="batch_id">
                                        <option value="">Select</option>
                                        @forelse($batches as $key => $batch)
                                            <option value="{{ $batch->id }}" {{ ($batch->id == $class->batch_id) ? 'selected' : '' }}>{{ $batch->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('batch_id')
                                    <small class="text-danger">{{ $errors->first('batch_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Subject</label>
                                <div class="mb-3">
                                    <select class="form-control" name="subject_id">
                                        <option value="">Select</option>
                                        @forelse($subjects as $key => $subject)
                                            <option value="{{ $subject->id }}" {{ ($subject->id == $class->subject_id) ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('subject_id')
                                    <small class="text-danger">{{ $errors->first('subject_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Faculty</label>
                                <div class="mb-3">
                                    <select class="form-control" name="faculty_id">
                                        <option value="">Select</option>
                                        @forelse($faculties as $key => $fac)
                                            <option value="{{ $fac->id }}" {{ ($fac->id == $class->faculty_id) ? 'selected' : '' }}>{{ $fac->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('faculty_id')
                                    <small class="text-danger">{{ $errors->first('faculty_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Class time</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="class_time" value="{{ $class->class_time }}" aria-label="Text" aria-describedby="text-addon" placeholder="Class Time">
                                </div>
                                @error('class_time')
                                    <small class="text-danger">{{ $errors->first('class_time') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="">Notes</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="notes" value="{{ $class->notes }}" aria-label="Text" aria-describedby="text-addon" placeholder="Notes">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Class Type</label>
                                <div class="mb-3">
                                    <select class="form-control" name="type">
                                        <option value="0" {{ ($class->type == 0) ? 'selected' : '' }}>Online</option>
                                        <option value="1" {{ ($class->type == 1) ? 'selected' : '' }}>Offline</option>
                                    </select>
                                </div>
                                @error('type')
                                    <small class="text-danger">{{ $errors->first('type') }}</small>
                                @enderror
                            </div>
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