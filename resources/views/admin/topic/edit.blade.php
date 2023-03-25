@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Update Topic</h5></div>
                    </div>
                    <form method="post" action="{{ route('topic.update', $topic->id) }}">
                        @csrf
                        @method("PUT")
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="req mb-1">Topic Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $topic->name }}" placeholder="Topic Name">                                    
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="req mb-1">Subject</label>
                                    <select class="form-control" name="subject_id">
                                        <option value="">Select</option>
                                        @forelse($subjects as $key => $subject)
                                            <option value="{{ $subject->id }}" {{ ($topic->subject_id == $subject->id) ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>                                  
                                </div>
                                @error('subject_id')
                                    <small class="text-danger">{{ $errors->first('subject_id') }}</small>
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