@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Exam Type</th>
                                <th>Batch</th>
                                <th>Cutoff Mark</th>
                                <th>Question Count</th>
                                <th>Exam Duration</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($etypes as $key => $exam)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>{{ $exam->batch?->name }}</td>
                                <td>{{ $exam->cut_off_mark }}</td>
                                <td>{{ $exam->question_count }}</td>
                                <td>{{ $exam->exam_duration }}</td>
                                <td>{{ $exam->status }}</td>
                                <td class="text-center"><a href="/admin/settings/exam/edit/{{$exam->id}}"><i class="fa fa-pencil text-warning"></i></a></td>
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