@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Question</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('question.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Subject Name</label>
                                <select class="form-control subject" data-random="0" name="subject_id">
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Module Name</label>
                                <select class="form-control module" name="topic_id">
                                    <option value="">Select</option>
                                    
                                </select>                                  
                            </div>
                            @error('topic_id')
                                <small class="text-danger">{{ $errors->first('topic_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req mb-1">Exam Levels</label>
                                <select class="form-control select2 selectall" name="levels[]" data-placeholder="Select Multiple if required" multiple>
                                    @forelse($levels as $key => $level)
                                        <option value="{{ $level->id }}">{{ $level->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                            @error('levels')
                                <small class="text-danger">{{ $errors->first('levels') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="req mb-1">Select All</label>
                            <input type="checkbox" class="sall" />
                        </div>
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
                        <div class="col-md-6"></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="req mb-1">Question</label>
                                <textarea class="form-control" rows="10" name="question" id="question" placeholder="Question">{{ old('question') }}</textarea>                               
                            </div>
                            @error('question')
                                <small class="text-danger">{{ $errors->first('question') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2"></div>
                        @for($i=1; $i<=$option_count; $i++)
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="req mb-1">Option {{ albhabets()[$i] }}</label>
                                    <textarea class="form-control" name="options[]" id="option{{$i}}" placeholder="Option {{ albhabets()[$i] }}" required></textarea>
                                    <input type="hidden" name="option_id[]" value="{{ $i }}">                               
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        @endfor
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Courses</label>
                                <select class="form-control select2" name="courses[]" data-placeholder="Select Multiple if required" multiple>
                                    <option value="">Select</option>
                                    @forelse($courses as $key => $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                            @error('courses')
                                <small class="text-danger">{{ $errors->first('courses') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="mb-1">Explanation</label>
                                <textarea class="form-control" rows="5" name="explanation" id="explanation" placeholder="Explanation">{{ old('explanation') }}</textarea>                               
                            </div>
                        </div>
                        <div class="col-md-2"></div>
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