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
                        <thead><tr><th>SL No</th><th>Exam Name</th><th>Batch</th><th>Cutoff Mark</th><th>Q. count</th><th>Duration</th><th>Exam Date</th><th class="text-center">Take</th></tr></thead><tbody>
                        @forelse($exams as $key => $exam)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->batch->name }}</td>
                                <td>{{ $exam->cut_off_mark }}</td>
                                <td>{{ $exam->question_count }}</td>
                                <td>{{ $exam->duration }} Minutes</td>
                                <td>{{ $exam->exam_date->format('d/M/Y') }}</td>
                                @if(!$exam->studentexam && !isStudentAttended($student->id))
                                <td class="text-center">{!! ($exam->exam_date->format('d/M/Y') == date('d/M/Y')) ? "<a href='/student/exam/$exam->id'>Take Exam</a>" : '' !!}</td>
                                @else
                                <td>{{ Auth::user()->student->id }}</td>
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