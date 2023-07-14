@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Fetch Student</h3>
            </div>            
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success text-white">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger text-white">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <form role="form" method="post" action="{{ route('report.student.fetch') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="mb-3">
                                    <input type="number" class="form-control" placeholder="Student ID" name="student" value="{{ ($inputs && $inputs[0]) ? $inputs[0] : '' }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('student')
                                    <small class="text-danger">{{ $errors->first('student') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-submit bg-gradient-primary">FETCH</button>
                        </div>                        
                    </div>
                </form>
                @if($student)
                <div class="row mt-5">
                    <div class="col">
                        <p class="fw-bold">Student Name: <span class="text-primary">{{ $student->name }}</span></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold">Admission Date: <span class="text-primary">{{ date('d/M/Y', strtotime($student->admission_date)) }}</span></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold">Batches: <span class="text-primary">{{ $batches }}</span></p>
                    </div>
                    <div class="col">
                        <p class="fw-bold">Photo: <span class="text-primary"><a href="storage/student-photos/{{ $student->id }}/{{ $student->photo }}" target="_blank">View</a></span></p>
                    </div>
                </div>
                @endif
                <div class="row mt-5">
                    <div class="col-12">
                        <h5>Admission Fee & Leave Details</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-light">
                                    <th>Batch</th>
                                    <th>Fee Advance</th>
                                    <th>Fee Balance</th>
                                    <th>Fee Balance Paid</th>
                                    <th>Date Paid</th>
                                    <th>Leave Count</th>
                                </thead>
                                <tbody>
                                    @forelse($records as $key => $student)
                                    <tr>
                                        <td>{{ $student->batch()->find($student->batch)->name }}</td>
                                        <td>{{ $student->studentname->admission_fee_advance }}</td>
                                        <td>{{ $student->studentname->admission_fee_balance }}</td>
                                        <td>{{ ($student->studentname->balance_received == 0 && $student->studentname->admission_fee_balance > 0) ? 'Not Paid' : 'Paid' }}</td>
                                        <td>{{ $student->studentname->admission_date->format('d/M/Y') }}</td>
                                        <td>{{ $student->studentname->attendances()->where('batch', $student->batch)->where('leave', 1)->count('leave') }}</td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <h5>Batch Fee Details</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-light">
                                    <th>Batch</th>
                                    <th>Fee Advance</th>
                                    <th>Fee Balance</th>
                                    <th>Fee Balance Paid</th>
                                    <th>Fee Month</th>
                                    <th>Date Paid</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @forelse($records as $key => $record)
                                    @php $fee = $record->studentname()->find($record->student)->batchFee() @endphp
                                    <tr>
                                        <td>{{ $record->batch()->find($record->batch)->name }}</td>
                                        <td>{{ $fee->value('fee') }}</td>
                                        <td>{{ $fee->value('fee_balance') }}</td>
                                        <td>{{ ($fee->value('fee_pending') == 0 && $fee->value('fee_balance') > 0) ? 'Not Paid' : 'Paid' }}</td>
                                        <td>{{ $fee->value('fee_month')  }} / {{ $fee->value('fee_year') }}</td>
                                        <td>{{ ($fee->value('paid_date')) ? date('d/M/Y', strtotime($fee->value('paid_date'))) : '' }}</td>
                                        <td class="text-center">{!! ($fee->value('fee') > 0) ? "<i class='fa fa-check text-success'>" : "<i class='fa fa-times text-danger'>" !!}</td>
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
</div>
@endsection