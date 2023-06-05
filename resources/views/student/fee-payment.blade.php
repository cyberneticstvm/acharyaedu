@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="row">
                    <div class="col-md-12"><h5 class="text-primary">Fee Payments</h5></div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
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
</div>
@endsection