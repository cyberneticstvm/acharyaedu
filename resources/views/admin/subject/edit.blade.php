@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Subject</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('subject.update', $subject->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Exam Type</label>
                                <div class="mb-3">
                                    <select class="form-control" name="exam_type">
                                        <option value="">Select</option>
                                        @forelse($etypes as $key => $etype)
                                            <option value="{{ $etype->id }}" {{ ($etype->id == $subject->exam_type) ? 'selected' : '' }}>{{ $etype->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('exam_type')
                                    <small class="text-danger">{{ $errors->first('exam_type') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="req">Subject Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $subject->name }}" placeholder="Subject Name">                                    
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
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