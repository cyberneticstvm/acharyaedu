@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Gallery</h3>
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
                <form role="form" method="post" action="{{ route('gallery.update', $gallery->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="title" value="{{ $gallery->title }}" placeholder="Title">
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="mb-1">Type</label>
                                <div class="mb-3">
                                    <select class="form-control" name="type">
                                        <option value="video" {{ ($gallery->type == 'video') ? 'selected' : '' }}>Video</option>
                                        <option value="image" {{ ($gallery->type == 'image') ? 'selected' : '' }}>Image</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Video URL</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="url" value="{{ $gallery->url }}" placeholder="url">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="mb-1">Attachment</label>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="attachment" />
                                </div>
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