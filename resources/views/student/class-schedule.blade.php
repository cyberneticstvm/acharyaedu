@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">{{ $student->name }}'s Class Schedule</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Batch Name</th><th>Faculty</th><th>Subject</th><th>Class Date</th><th>Class Time</th><th>Notes</th><th>Link</th></tr></thead>
                            <tbody>
                            @forelse($schedules as $key => $sc)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $sc->batch->name }}</td>
                                <td>{{ $sc->faculty->name }}</td>
                                <td>{{ $sc->subject->name }}</td>
                                <td>{{ $sc->class_date->format('d/M/Y') }}</td>
                                <td>{{ $sc->class_time }}</td>
                                <td>{{ $sc->notes }}</td>
                                <td><a href="{{ $sc->link }}" target="_blank">Link</a></td>
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