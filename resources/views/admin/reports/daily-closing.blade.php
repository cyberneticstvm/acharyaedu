@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Income Expense Statement</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('daily.closing.fetch') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">From Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="from_date" value="{{ ($inputs && $inputs[0]) ? $inputs[0] : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('from_date')
                                <small class="text-danger">{{ $errors->first('from_date') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">To Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="to_date" value="{{ ($inputs && $inputs[1]) ? $inputs[1] : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('to_date')
                                <small class="text-danger">{{ $errors->first('to_date') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">FETCH</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table text-right">
                                <thead class="bg-default">
                                    <tr>
                                        <th scope="col" class="pe-2">Particulars</th>
                                        <th scope="col" class="pe-2">Income</th>
                                        <th scope="col" class="pe-2">Expense</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Opening Balance</td>
                                        <td class="text-end text-success fw-bold">{{ number_format($opening_balance, 2) }}</td>
                                        <td class="text-end"></td>
                                    </tr>
                                    <tr>
                                        <td>Income from Admission</td>
                                        <td class="text-end">{{ number_format($students->sum('fee'), 2) }}</td>
                                        <td class="text-end"></td>
                                    </tr>
                                    <tr>
                                        <td>Income from Batch</td>
                                        <td class="text-end">{{ number_format($fee->sum('fee_advance'), 2) }}</td>
                                        <td class="text-end"></td>
                                    </tr>
                                    <tr>
                                        <td>Income from other sources</td>
                                        <td class="text-end">{{ number_format($income->sum('amount'), 2) }}</td>
                                        <td class="text-end"></td>
                                    </tr>
                                    <tr>
                                        <td>Expenses</td>
                                        <td class="text-end"></td>
                                        <td class="text-end">{{ number_format($expense->sum('amount'), 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Closing Balance</td>
                                        <td class="text-end"></td>
                                        <td class="text-end text-info fw-bold">{{ number_format($closing_balance, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection