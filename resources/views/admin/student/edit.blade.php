@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Student</h3>
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
                <form role="form" method="post" action="{{ route('student.update', $student->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Date of Admission</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="admission_date" value="{{ $student->admission_date?->format('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Student Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Student Name" name="name" value="{{ $student->name }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Email ID</label>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email ID" name="email" value="{{ $student->email }}" aria-label="Email" aria-describedby="email-addon">
                                </div>
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Mobile Number</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="{{ $student->mobile }}" maxlength="10" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Alternative Mobile</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Alternative Mobile" name="mobile_alt" value="{{ $student->mobile_alt }}" maxlength="10" aria-label="Text" aria-describedby="text-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date of Birth</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="dob" value="{{ $student->dob }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Educational Qualification</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Educational Qualification" name="qualification" value="{{ $student->qualification }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Reservation Category</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Reservation Category" name="category" value="{{ $student->category }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Profile Photo</label>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="photo" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Branch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="branch">
                                        <option value="">Select</option>
                                        @forelse($branches as $key => $branch)
                                        <option value="{{ $branch->id }}" {{ ($branch->id == $student->branch) ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('branch')
                                <small class="text-danger">{{ $errors->first('branch') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Type</label>
                                <select class="form-control" name="type">
                                    <option value="online" {{ ($student->type == 'online') ? 'selected' : '' }}>Online</option>
                                    <option value="offline" {{ ($student->type == 'offline') ? 'selected' : '' }}>Offline</option>
                                </select>
                                @error('type')
                                <small class="text-danger">{{ $errors->first('type') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Status</label>
                                <select class="form-control" name="status">
                                    <option value="active" {{ ($student->user->status == 'active') ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ ($student->user->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <small class="text-danger">{{ $errors->first('status') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req">Address</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="address" placeholder="Address">{{ $student->address }}</textarea>
                                </div>
                                @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h5>Admission Fee Details</h5>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Admission Fee</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="fee" min="0" step="any" value="{{ $student->fee }}" placeholder="0.00" />
                                </div>
                                @error('fee')
                                <small class="text-danger">{{ $errors->first('fee') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Admission Fee Advance</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="admission_fee_advance" min="1" step="1" value="{{ $student->admission_fee_advance }}" placeholder="0.00" />
                                </div>
                                @error('admission_fee_advance')
                                <small class="text-danger">{{ $errors->first('admission_fee_advance') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="">Admission Fee Balance</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="admission_fee_balance" value="{{ $student->admission_fee_balance }}" placeholder="0.00" />
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
                                        <option value="{{ $pmode->id }}" {{ ($student->payment_mode == $pmode->id) ? 'selected' : '' }}>{{ $pmode->name }}</option>
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
                                    <input type="date" class="form-control" name="tentative_date" value="{{ ($student->tentative_date) ? $student->tentative_date->format('Y-m-d') : '' }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Balance Fee Received</label>
                                <div class="mb-3">
                                    <select class="form-control" name="balance_received">
                                        <option value="">Select</option>
                                        <option value="0" {{ ($student->balance_received == 0) ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ ($student->balance_received == 1) ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">Remarks</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="remarks" placeholder="Remarks">{{ $student->remarks }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">UPADTE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection