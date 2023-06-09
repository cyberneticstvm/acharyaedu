@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="row">
                    <div class="col-md-12"><h5 class="text-primary">PSC Updates</h5></div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        @php $slno = 1; @endphp
                            <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                            <thead><tr><th>SL No</th><th>Title</th><th>Month</th><th>Year</th><th>Description</th><th>Attachment</th></tr></thead>
                                <tbody>
                                @forelse($updates as $key => $update)
                                <tr>
                                    <td>{{ $slno++ }}</td>
                                    <td>{{ $update->title }}</td>
                                    <td>{{ $update->pmonth }}</td>
                                    <td>{{ $update->pyear }}</td>
                                    <td>{{ $update->description }}</td>
                                    <td class="text-center"><a href="{{ asset('storage/'.$update->attachment) }}" target="_blank">{{ ($update->attachment) ? 'Attachment' : '' }}</a></td>
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