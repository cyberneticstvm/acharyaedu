@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Student Leave Register</h3></div>
                </div>                
            </div>
            <div class="card-body">
                @csrf
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Student Name</th><th>Batch</th><th>Leave Date</th><th>Reason</th></tr></thead><tbody>
                        @forelse($attendance as $key => $at)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $at->studentName->name }}</td>
                                <td>{{ $at->batchName->name }}</td>
                                <td>{{ $at->date->format('d/M/Y') }}</td>
                                <td>{{ $at->reason }}</td>
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