@extends("student.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-primary text-center">{{ $student->name }}'s Exam Performance ({{ $exam->studentexam->exam->name }})</h5>
                        </div>
                        <div class="col-md-12 mt-5">
                            <input type="hidden" id="student_exam_id" value="{{ $exam->student_exam_id }}" />
                            <div id="studPerfChart" class="cls"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection