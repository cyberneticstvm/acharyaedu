@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Admission Fee</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('admission.fee.update', $fee->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">Student ID</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="student_id" value="{{ $fee->student_id }}" placeholder="Student ID">
                                </div>
                                @error('student_id')
                                <small class="text-danger">{{ $errors->first('student_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Batch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="batch_id">
                                        @forelse($batches as $key => $bat)
                                        <option value="{{ $bat->id }}" {{ ($bat->id == $fee->batch_id) ? 'selected' : '' }}>{{ $bat->name }}</option>
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
                                <label class="req">Amount</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="amount" min="1" step="1" value="{{ $fee->amount }}" placeholder="0.00" />
                                </div>
                                @error('fee')
                                <small class="text-danger">{{ $errors->first('fee') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Payment Mode</label>
                                <div class="mb-3">
                                    <select class="form-control" name="payment_mode">
                                        <option value="">Select</option>
                                        @forelse($pmodes as $key => $pmode)
                                        <option value="{{ $pmode->id }}" {{ ($pmode->id == $fee->payment_mode) ? 'selected' : '' }}>{{ $pmode->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('payment_mode')
                                <small class="text-danger">{{ $errors->first('payment_mode') }}</small>
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
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">Update</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection