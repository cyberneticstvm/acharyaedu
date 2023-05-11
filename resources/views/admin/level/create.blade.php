@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Subject Level</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('level.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="req mb-1">Subject Level Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Subject Level Name">                                    
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
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