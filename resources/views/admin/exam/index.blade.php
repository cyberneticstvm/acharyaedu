@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Exam Register</h5></div>
                        <div class="col text-end"><a href="/admin/exam/create"><i class="fa fa-plus fw-bold fa-lg text-primary"></i></a></div>
                    </div>
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-bordered">
                        <thead><tr><th>SL No</th><th>Exam Name</th><th>Batch</th><th>Cutoff Mark</th><th>Q. count</th><th>Duration</th><th>Exam Date</th><th>Edit</th><th>Delete</th></tr></thead><tbody>
                        @forelse($exams as $key => $exam)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td><a href="/admin/eq/create/{{ $exam->id }}">{{ $exam->name }}</a></td>
                                <td>{{ $exam->batch->name }}</td>
                                <td>{{ $exam->cut_off_mark }}</td>
                                <td>{{ $exam->question_count }}</td>
                                <td>{{ $exam->duration }} Minutes</td>
                                <td>{{ $exam->exam_date->format('d/M/Y') }}</td>
                                <td class="text-center"><a href="/admin/exam/edit/{{$exam->id}}"><i class="fa fa-pencil text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('exam.delete', $exam->id) }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </td>
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