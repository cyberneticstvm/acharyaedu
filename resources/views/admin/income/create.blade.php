@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Income</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('income.save') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date" value="{{ (old('date')) ? old('date') : date('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('date')
                                    <small class="text-danger">{{ $errors->first('date') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Amount</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" placeholder="0.00" name="amount" value="{{ old('amount') }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('amount')
                                    <small class="text-danger">{{ $errors->first('amount') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Head</label>
                                <div class="mb-3">
                                    <select class="form-control" name="head">
                                        <option value="">Select</option>
                                        @forelse($heads as $key => $head)
                                            <option value="{{ $head->id }}">{{ $head->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('head')
                                    <small class="text-danger">{{ $errors->first('head') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="req">Description</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description" />
                                </div>
                                @error('description')
                                    <small class="text-danger">{{ $errors->first('description') }}</small>
                                @enderror
                            </div>
                        </div>                        
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">CREATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection