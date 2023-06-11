@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">{{ $student->name }}'s Exam Performance ({{ $exam->studentexam->exam->name }})</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mt-5">
                        <input type="hidden" id="student_exam_id" value="{{ $exam->student_exam_id }}" />
                        <input type="hidden" id="student_exam_type" value="{{ $type }}" />
                        <div id="chart">
                            <canvas id="studentPerformanceChart" class="chart-canvas" height="300" width="755" style="display: block; box-sizing: border-box; height: 300px; width: 755px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection