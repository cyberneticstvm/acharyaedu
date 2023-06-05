@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="row">
                    <div class="col-md-12"><h5 class="text-primary">{{ $student->name }}'s Class Schedule</h5></div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        @php $slno = 1; @endphp
                            <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                            <thead><tr><th>SL No</th><th>Batch Name</th><th>Faculty</th><th>Subject</th><th>Class Date</th><th>Class Time</th><th>Notes</th></tr></thead>
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
</div>
@endsection