@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Module</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('topic.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req mb-1">Module Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Topic Name">                                    
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
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                            @error('subject_id')
                                <small class="text-danger">{{ $errors->first('subject_id') }}</small>
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