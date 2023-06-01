@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Faculty</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('faculty.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Faculty Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" aria-label="Text" aria-describedby="text-addon" placeholder="Faculty Name">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Mobile Number</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" aria-label="Text" aria-describedby="text-addon" placeholder="Mobile Number" maxlength="10">
                                </div>
                                @error('mobile')
                                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
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