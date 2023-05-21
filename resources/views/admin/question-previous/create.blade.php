@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Previous Question</h3>
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
                <form role="form" method="post" action="{{ route('previousquestion.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Available for free</label>
                                <select class="form-control" name="available_for_free">
                                    <option value="">Select</option>
                                    <option value="1" {{ (old('available_for_free') == 1) ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ (old('available_for_free') == 0) ? 'selected' : '' }}>No</option>
                                </select>                                  
                            </div>
                            @error('available_for_free')
                                <small class="text-danger">{{ $errors->first('available_for_free') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Select</option>
                                    <option value="1" {{ (old('status') == 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ (old('status') == 0) ? 'selected' : '' }}>Inactive</option>
                                </select>                                  
                            </div>
                            @error('status')
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Question</label>
                                <textarea class="form-control" rows="10" name="question" id="question" placeholder="Question">{{ old('question') }}</textarea>                               
                            </div>
                            @error('question')
                                <small class="text-danger">{{ $errors->first('question') }}</small>
                            @enderror
                        </div>
                        @for($i=1; $i<=$option_count; $i++)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="req mb-1">Option {{ albhabets()[$i] }}</label>
                                    <textarea class="form-control" name="options[]" id="option{{$i}}" placeholder="Option {{ albhabets()[$i] }}" required></textarea>
                                    <input type="hidden" name="option_id[]" value="{{ $i }}">                               
                                </div>
                            </div>
                        @endfor
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-1">Explanation</label>
                                <textarea class="form-control" rows="5" name="explanation" id="explanation" placeholder="Explanation">{{ old('explanation') }}</textarea>                               
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Correct Option</label>
                                <select class="form-control" name="correct_option">
                                    <option value="">Select</option>
                                    @for($i=1; $i<=$option_count; $i++)
                                    <option value="{{ $i }}">{{ albhabets()[$i] }}</option>
                                    @endfor
                                </select>                                  
                            </div>
                            @error('correct_option')
                                <small class="text-danger">{{ $errors->first('correct_option') }}</small>
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