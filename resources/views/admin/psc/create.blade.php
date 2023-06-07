@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create PSC Update</h3>
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
                <form role="form" method="post" action="{{ route('psc.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Month</label>
                                <div class="mb-3">
                                    <select class="form-control" name="pmonth">
                                        <option value="">Select</option>
                                        @forelse($months as $key => $month)
                                            <option value="{{ $month->id }}">{{ $month->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('pmonth')
                                    <small class="text-danger">{{ $errors->first('pmonth') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Fee Year</label>
                                <div class="mb-3">
                                    <select class="form-control" name="pyear">
                                        <option value="">Select</option>
                                        @forelse($years as $key => $year)
                                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('pyear')
                                    <small class="text-danger">{{ $errors->first('pyear') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req mb-1">Attachment</label>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="attachment" />
                                </div>
                                @error('attachment')
                                    <small class="text-danger">{{ $errors->first('attachment') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">Description</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description" />
                                </div>
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