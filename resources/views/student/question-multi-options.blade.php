@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bolder text-primary text-gradient">Multiple Choice Question Register</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered tblFilter">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Subject</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subjects as $key => $item)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td><a href="{{ route('student.multi.options.question.subject', $item->id) }}" target="_blank">{{ $item->name }}</a></td>
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