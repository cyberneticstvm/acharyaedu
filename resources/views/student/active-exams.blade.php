@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">{{ $student->name }}'s Exam Register</h3></div>
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                        <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Exam Name</th><th>Batch</th><th>Exam Date</th><th>Correct</th><th>Wrong</th><th>Unattended</th><th>Score</th><th>Grade</th><th class="text-center">Answer</th><th>Performance</th><th class="text-center">Take</th></tr></thead>
                            <tbody>
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
                                <td class="text-center"><a target="_blank" href="/student/exam/result/{{ ($se) ? encrypt($se->id) : 0 }}/paid"><i class="fa fa-eye text-info"></a></td>
                                <td class="text-center"><a href="/student/exam/performance/{{ ($se) ? encrypt($se->id) : 0 }}/paid"><i class="fa fa-line-chart text-success"></i></a></td>
                                @if(!isStudentAttended($student->id, $exam->id))
                                <td class="text-center">{!! ($exam->exam_date->format('d/M/Y') == date('d/M/Y')) ? "<a href='/student/exam/$exam->id/paid'>Take Exam</a>" : '' !!}</td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection