@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update SCERT Question</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('scertquestion.update', $question->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req mb-1">Class Levels</label>
                                {!! Form::select('levels[]', $levels->pluck('name', 'id')->all(),  $question->level->id, ['class' => 'form-control select2']) !!}                                  
                            </div>
                            @error('levels')
                                <small class="text-danger">{{ $errors->first('levels') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Subject Name</label>
                                <select class="form-control subject" data-random="0" name="subject_id">
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
                                <label class="req mb-1">Chapter</label>
                                <select class="form-control" name="chapter_id" data-placeholder="Select">
                                    @forelse($chapters as $key => $chapter)
                                        <option value="{{ $chapter->id }}" {{ ($question->chapter_id == $chapter->id) ? 'selected' : '' }}>{{ $chapter->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                            @error('chapter_id')
                                <small class="text-danger">{{ $errors->first('chapter_id') }}</small>
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
                                <textarea class="form-control" rows="10" name="question" id="question" placeholder="Question">{{ $question->question }}</textarea>                               
                            </div>
                            @error('question')
                                <small class="text-danger">{{ $errors->first('question') }}</small>
                            @enderror
                        </div>
                        @forelse($question->options as $key => $option)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="req mb-1">Option {{ albhabets()[$option->option_id] }}</label>
                                    <textarea class="form-control" name="options[]" id="option{{$key+1}}" placeholder="Option {{ $option->option_id }}" required>{{ $option->where('option_id', $option->option_id)->where('question_id', $question->id)->value('option_name') }}</textarea>
                                    <input type="hidden" name="option_id[]" value="{{ $option->option_id }}">                               
                                </div>
                            </div>
                        @empty
                        @endforelse
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mb-1">Explanation</label>
                                <textarea class="form-control" rows="5" name="explanation" id="explanation" placeholder="Explanation">{{ $question->explanation }}</textarea>                               
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Correct Option</label>
                                <select class="form-control" name="correct_option">
                                    <option value="">Select</option>
                                    @for($i=1; $i<=$question->options()->count(); $i++)
                                    <option value="{{ $i }}" {{ ($question->correct_option == $i) ? 'selected' : '' }}>{{ albhabets()[$i] }}</option>
                                    @endfor
                                </select>                                  
                            </div>
                            @error('correct_option')
                                <small class="text-danger">{{ $errors->first('correct_option') }}</small>
                            @enderror
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