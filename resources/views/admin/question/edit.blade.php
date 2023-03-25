@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Update Question</h5></div>
                    </div>
                    <form method="post" action="{{ route('question.update', $question->id) }}">
                        @csrf
                        @method("PUT")
                        <div class="row g-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="req mb-1">Subject Name</label>
                                    <select class="form-control" name="subject_id">
                                        <option value="">Select</option>
                                        @forelse($subjects as $key => $subject)
                                            <option value="{{ $subject->id }}" {{ ($question->subject_id == $subject->id) ? 'selected' : '' }}>{{ $subject->name }}</option>
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
                                    <label class="req mb-1">Topic Name</label>
                                    <select class="form-control" name="topic_id">
                                        <option value="">Select</option>
                                        @forelse($topics as $key => $topic)
                                            <option value="{{ $topic->id }}" {{ ($question->topic_id == $topic->id) ? 'selected' : '' }}>{{ $topic->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>                                  
                                </div>
                                @error('topic_id')
                                    <small class="text-danger">{{ $errors->first('topic_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="req mb-1">Level Name</label>
                                    <select class="form-control" name="level_id">
                                        <option value="">Select</option>
                                        @forelse($levels as $key => $level)
                                            <option value="{{ $level->id }}" {{ ($question->level_id == $level->id) ? 'selected' : '' }}>{{ $level->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>                                  
                                </div>
                                @error('level_id')
                                    <small class="text-danger">{{ $errors->first('level_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="req mb-1">Available for free</label>
                                    <select class="form-control" name="available_for_free">
                                        <option value="">Select</option>
                                        <option value="1" {{ ($question->available_for_free == 1) ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ ($question->available_for_free == 0) ? 'selected' : '' }}>No</option>
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
                                        <option value="1" {{ ($question->status == 1) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ ($question->status == 0) ? 'selected' : '' }}>Inactive</option>
                                    </select>                                  
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="req mb-1">Question</label>
                                    <textarea class="form-control" rows="10" name="question" placeholder="Question">{{ $question->question }}</textarea>                               
                                </div>
                                @error('question')
                                    <small class="text-danger">{{ $errors->first('question') }}</small>
                                @enderror
                            </div>
                            @forelse($question->options as $key => $option)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="req mb-1">Option {{ $option->option_id }}</label>
                                        <textarea class="form-control" name="options[]" placeholder="Option {{ $option->option_id }}" required>{{ $option->where('option_id', $option->option_id)->value('option_name') }}</textarea>
                                        <input type="hidden" name="option_id[]" value="{{ $option->option_id }}">                               
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="req mb-1">Courses</label>
                                    {!! Form::select('courses[]', $courses->pluck('name', 'id')->all(),  $question->courses()->pluck('course_id')->toArray(), ['class' => 'form-control select2', 'multiple']) !!}                                  
                                </div>
                                @error('courses')
                                    <small class="text-danger">{{ $errors->first('courses') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="req mb-1">Correct Option</label>
                                    <select class="form-control" name="correct_option">
                                        <option value="">Select</option>
                                        @for($i=1; $i<=$question->options()->count(); $i++)
                                        <option value="{{ $i }}" {{ ($question->correct_option == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>                                  
                                </div>
                                @error('correct_option')
                                    <small class="text-danger">{{ $errors->first('correct_option') }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3 text-end">
                                <button type="submit" class="btn btn-submit btn-primary text-uppercase fs-6">Update</button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection