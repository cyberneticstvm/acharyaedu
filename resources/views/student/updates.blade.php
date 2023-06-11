@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">PSC Updates</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
@endsection