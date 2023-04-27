@extends("student.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">{{ $student->name }}'s Exam Register</h5></div>
                    </div>
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-bordered">
                        <thead><tr><th>SL No</th><th>Exam Name</th><th>Batch</th><th>Exam Date</th><th>Correct</th><th>Wrong</th><th>Unattended</th><th>Score</th><th>Grade</th><th class="text-center">Answer</th><th>Performance</th><th class="text-center">Take</th></tr></thead><tbody>
                        @forelse($exams as $key => $exam)
                            @php $se = getStudentScore($student->id, $exam->id) @endphp
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->batch->name }}</td>
                                <td>{{ $exam->exam_date->format('d/M/Y') }}</td>
                                <td>{{ ($se) ? $se->correct_answer_count : 0 }}</td>
                                <td>{{ ($se) ? $se->wrong_answer_count : 0 }}</td>
                                <td>{{ ($se) ? $se->unattended_count : 0 }}</td>
                                <td>{{ ($se) ? $se->total_mark_after_cutoff: 0 }}</td>
                                <td>{{ ($se) ? $se->grade : 0 }}</td>
                                <td class="text-center"><a target="_blank" href="/student/exam/result/{{ ($se) ? $se->id : 0 }}"><i class="fa fa-eye text-info"></a></td>
                                <td class="text-center"><a href="/student/exam/performance/{{ ($se) ? $se->id : 0 }}"><i class="fa fa-line-chart text-success"></i></a></td>
                                @if(!isStudentAttended($student->id, $exam->id))
                                <td class="text-center">{!! ($exam->exam_date->format('d/M/Y') == date('d/M/Y')) ? "<a href='/student/exam/$exam->id'>Take Exam</a>" : '' !!}</td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                        @empty
                        @endforelse
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection