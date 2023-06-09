@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Fee Payments</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Batch Name</th><th>Month</th><th>Year</th><th>Paid Date</th></tr></thead>
                            <tbody>
                            @forelse($fees as $key => $fee)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $fee->batches->name }}</td>
                                <td>{{ $fee->fee_month }}</td>
                                <td>{{ $fee->fee_year }}</td>
                                <td>{{ $fee->paid_date->format('d/M/Y') }}</td>
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