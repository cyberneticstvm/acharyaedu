@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">{{ $exam->name }} for {{ $exam->batch->name }} Result</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Student Name</th><th>Correct</th><th>Wrong</th><th>Unattended</th><th>Score</th><th>Grade</th><th class="text-center">Answer</th><th>Performance</th></tr></thead><tbody>
                            @php $slno = 1; @endphp
                            @forelse($students as $key => $student)
                                @php $se = getStudentScore($student->student, $exam->id) @endphp
                                <tr>
                                    <td>{{ $slno++ }}</td>
                                    <td>{{ $student->studentname->name }}</td>
                                    <td>{{ ($se) ? $se->correct_answer_count : 0 }}</td>
                                    <td>{{ ($se) ? $se->wrong_answer_count : 0 }}</td>
                                    <td>{{ ($se) ? $se->unattended_count : 0 }}</td>
                                    <td>{{ ($se) ? $se->total_mark_after_cutoff: 0 }}</td>
                                    <td>{{ ($se) ? $se->grade : 0 }}</td>
                                    <td class="text-center"><a target="_blank" href="/admin/exam/result/{{ ($se) ? $se->id : 0 }}"><i class="fa fa-eye text-info"></a></td>
                                    <td class="text-center"><a href="/admin/exam/performance/{{ ($se) ? $se->id : 0 }}"><i class="fa fa-line-chart text-success"></i></a></td>
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