@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create General Question</h3>
            </div>
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
            <div class="card-body">
                <form role="form" method="post" action="{{ route('question.general.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req mb-1">Courses</label>
                                <select class="form-control select2 subject" name="course_id[]" multiple>
                                    <option value="">Select</option>
                                    @forelse($courses as $key => $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            @error('course_id')
                            <small class="text-danger">{{ $errors->first('course_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req mb-1">Subject Name</label>
                                <select class="form-control" name="subject_id">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req">Question</label>
                                <textarea class="form-control" name="question" placeholder="Question">{{ old('question') }}</textarea>
                            </div>
                            @error('question')
                            <small class="text-danger">{{ $errors->first('question') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req">Answer</label>
                                <textarea class="form-control" name="answer" placeholder="Answer">{{ old('answer') }}</textarea>
                            </div>
                            @error('answer')
                            <small class="text-danger">{{ $errors->first('answer') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="">Explanation</label>
                                <textarea class="form-control" name="explanation" placeholder="Explanation">{{ old('explanation') }}</textarea>
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