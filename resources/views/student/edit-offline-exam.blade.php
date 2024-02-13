@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Exam Score</h3>
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
                <form role="form" method="put" action="{{ route('student.offline.exams.update', $exam->id) }}">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}" />
                    <input type="hidden" name="student_exam_id" value="{{ $studentexam->id }}" />
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req mb-1">Exam Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $exam->name }}" readonly>
                            </div>
                            @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Correct Answer</label>
                                <input type="text" class="form-control" name="correct_answer" value="" placeholder="0">
                            </div>
                            @error('correct_answer')
                            <small class="text-danger">{{ $errors->first('correct_answer') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req mb-1">Wrong Answer</label>
                                <input type="text" class="form-control" name="wrong_answer" value="" placeholder="0">
                            </div>
                            @error('wrong_answer')
                            <small class="text-danger">{{ $errors->first('wrong_answer') }}</small>
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