@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Slider</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('slider.update', $slider->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Title</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Title" name="title" value="{{ $slider->title }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req">Slider Image (1920w X 1280h)</label>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="image" />
                                </div>
                                @error('image')
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Order</label>
                                <select class="form-control" name="order">
                                    <option value="1" {{ ($slider->order == 1) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ ($slider->order == 2) ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ ($slider->order == 3) ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ ($slider->order == 4) ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ ($slider->order == 5) ? 'selected' : '' }}>5</option>
                                </select>
                                @error('order')
                                    <small class="text-danger">{{ $errors->first('order') }}</small>
                                @enderror
                            </div>
                        </div>                                               
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req">Text1</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="text1" placeholder="Text1">{{ $slider->text1 }}</textarea>
                                </div>
                                @error('text1')
                                    <small class="text-danger">{{ $errors->first('text1') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req">Text2</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="text2" placeholder="Text1">{{ $slider->text2 }}</textarea>
                                </div>
                                @error('text2')
                                    <small class="text-danger">{{ $errors->first('text2') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req">Text3</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="text3" placeholder="Text3">{{ $slider->text3 }}</textarea>
                                </div>
                                @error('text3')
                                    <small class="text-danger">{{ $errors->first('text3') }}</small>
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