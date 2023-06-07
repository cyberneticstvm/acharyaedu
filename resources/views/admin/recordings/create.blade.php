@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Video Record</h3>
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
                <form role="form" method="post" action="{{ route('record.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
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
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Video type</label>
                                <div class="mb-3">
                                    <select class="form-control" name="type">
                                        <option value="Free">Free</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                                @error('type')
                                    <small class="text-danger">{{ $errors->first('type') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Video Category</label>
                                <div class="mb-3">
                                    <select class="form-control" name="category">
                                        <option value="Recordings">Recordings</option>
                                        <option value="Zoom">Zoom Live</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                @error('category')
                                    <small class="text-danger">{{ $errors->first('category') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Video ID</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="video_id" value="{{ old('video_id') }}" placeholder="Video ID" />
                                </div>
                                @error('video_id')
                                    <small class="text-danger">{{ $errors->first('video_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">Description</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="description" value="{{ old('notes') }}" placeholder="Description" />
                                </div>
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