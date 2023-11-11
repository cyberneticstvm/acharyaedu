@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Multiple Options Question</h3>
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
                <form role="form" method="post" action="{{ route('multi-option.update', $question->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Question</label>
                                <textarea class="form-control" rows="10" name="question" id="question" placeholder="Question">{{ $question->question }}</textarea>
                            </div>
                            @error('question')
                            <small class="text-danger">{{ $errors->first('question') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Option A</label>
                                <textarea class="form-control" name="option_id[]" id="option1" placeholder="Option A" required>{{ $question->option_a }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Option B</label>
                                <textarea class="form-control" name="option_id[]" id="option2" placeholder="Option B" required>{{ $question->option_b }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Option C</label>
                                <textarea class="form-control" name="option_id[]" id="option3" placeholder="Option C" required>{{ $question->option_c }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Option D</label>
                                <textarea class="form-control" name="option_id[]" id="option4" placeholder="Option D" required>{{ $question->option_d }}</textarea>
                            </div>
                        </div>
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
                                    @for($i=1; $i<=4; $i++) <option value="{{ $i }}" {{ ($question->correct_option == $i) ? 'selected' : '' }}>{{ albhabets()[$i] }}</option>
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