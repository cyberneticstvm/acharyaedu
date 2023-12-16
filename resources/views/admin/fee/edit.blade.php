@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Fee</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('fee.update', $fee->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Fee Paid Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="paid_date" value="{{ $fee->paid_date->format('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('paid_date')
                                <small class="text-danger">{{ $errors->first('paid_date') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Student Name</label>
                                <div class="mb-3">
                                    <select class="form-control" name="student">
                                        <option value="{{ $student->id }}" {{ ($student->id == $fee->student) ? 'selected' : '' }}>{{ $student->name }}</option>
                                    </select>
                                </div>
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Batch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="batch">
                                        @forelse($student->batches as $key => $bat)
                                        <option value="{{ $bat->batch }}" {{ ($bat->batch == $fee->batch) ? 'selected' : '' }}>{{ $batch->find($bat->batch)->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Fee Month</label>
                                <div class="mb-3">
                                    <select class="form-control" name="fee_month">
                                        <option value="">Select</option>
                                        @forelse($months as $key => $month)
                                        <option value="{{ $month->id }}" {{ ($month->id == $fee->fee_month) ? 'selected' : '' }}>{{ $month->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('fee_month')
                                <small class="text-danger">{{ $errors->first('fee_month') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Fee Year</label>
                                <div class="mb-3">
                                    <select class="form-control" name="fee_year">
                                        <option value="">Select</option>
                                        @forelse($years as $key => $year)
                                        <option value="{{ $year->year }}" {{ ($year->year == $fee->fee_year) ? 'selected' : '' }}>{{ $year->year }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('fee_year')
                                <small class="text-danger">{{ $errors->first('fee_year') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Fee Advance</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="fee_advance" min="1" step="1" value="{{ $fee->fee_advance }}" placeholder="0.00" />
                                </div>
                                @error('fee_advance')
                                <small class="text-danger">{{ $errors->first('fee_advance') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="">Fee Balance</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="fee_balance" step="any" value="{{ $fee->fee_balance }}" placeholder="0.00" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Payment Mode</label>
                                <div class="mb-3">
                                    <select class="form-control" name="payment_mode">
                                        <option value="">Select</option>
                                        @forelse($pmodes as $key => $pmode)
                                        <option value="{{ $pmode->id }}" {{ ($fee->payment_mode == $pmode->id) ? 'selected' : '' }}>{{ $pmode->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('payment_mode')
                                <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Tentative Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="tentative_date" value="{{ ($fee->tentative_date) ? $fee->tentative_date->format('Y-m-d') : '' }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Discount Applicable</label>
                                <div class="mb-3">
                                    <select class="form-control" name="discount_applicable">
                                        <option value="">Select</option>
                                        <option value="0" {{ ($fee->discount_applicable == 0) ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ ($fee->discount_applicable == 1) ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                @error('discount_applicable')
                                <small class="text-danger">{{ $errors->first('discount_applicable') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Pending Fee</label>
                                <div class="mb-3">
                                    <select class="form-control" name="fee_pending">
                                        <option value="">Select</option>
                                        <option value="0" {{ ($fee->fee_pending == 0) ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ ($fee->fee_pending == 1) ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                @error('fee_pending')
                                <small class="text-danger">{{ $errors->first('fee_pending') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">Remarks</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="remarks" placeholder="Remarks">{{ $fee->remarks }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">UPDATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection