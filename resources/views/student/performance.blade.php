@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div id="form-messages">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-primary">{{ $student->name }}'s Exam Performance ({{ $exam->studentexam->exam->name }})</h5>
                        </div>
                        <div class="col-md-12 mt-5">
                            <input type="hidden" id="student_exam_id" value="{{ $exam->student_exam_id }}" />
                            <input type="hidden" id="student_exam_type" value="{{ $type }}" />
                            <div id="studPerfChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection