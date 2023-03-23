@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Create Subject Level</h5></div>
                    </div>
                    <form method="post" action="{{ route('level.save') }}">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="req mb-1">Subject Level Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Subject Level Name">                                    
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3 text-end">
                                <button type="submit" class="btn btn-submit btn-primary text-uppercase fs-6">Save</button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection