@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Batch</h3>
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
                <form role="form" method="post" action="{{ route('batch.update', $batch->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Batch Type</label>
                                <div class="mb-3">
                                    <select class="form-control" name="batch_type">
                                        <option value="">Select</option>
                                        <option value="Online" {{ ($batch->batch_type == 'Online') ? 'selected' : '' }}>Online</option>
                                        <option value="Offline" {{ ($batch->batch_type == 'Offline') ? 'selected' : '' }}>Offline</option>                                        
                                    </select>
                                </div>
                                @error('batch_type')
                                    <small class="text-danger">{{ $errors->first('batch_type') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Batch Start Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="start_date" value="{{ $batch->start_date }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Batch Name</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Batch Name" name="name" value="{{ $batch->name }}" aria-label="Text" aria-describedby="text-addon">
                                </div>
                                @error('name')
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="req">Course Name</label>
                                {!! Form::select('courses[]', $courses->pluck('name', 'id')->all(),  $batch->courses()->pluck('course_id')->toArray(), ['class' => 'form-control select2', 'multiple']) !!}
                                @error('courses')
                                    <small class="text-danger">{{ $errors->first('courses') }}</small>
                                @enderror
                            </div>
                        </div>                        
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Fee / Student</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="fee" min="1" step="1" value="{{ $batch->fee }}" placeholder="0.00" />
                                </div>
                                @error('fee')
                                    <small class="text-danger">{{ $errors->first('fee') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Status</label>
                                <div class="mb-3">
                                    <select class="form-control" name="status">
                                        <option value="">Select</option>
                                        <option value="0" {{ ($batch->status == 0) ? 'selected' : '' }}>Expired</option>
                                        <option value="1" {{ ($batch->status == 1) ? 'selected' : '' }}>Active</option>
                                    </select>
                                </div>
                                @error('status')
                                    <small class="text-danger">{{ $errors->first('status') }}</small>
                                @enderror
                            </div>
                        </div> 
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="req">Syllabus</label>
                                <div class="mb-3">
                                    <select class="form-control select2" name="syllabi[]" data-placeholder="Select" multiple>
                                        @forelse($syllabi as $key => $syl)
                                            @php $selected = '' @endphp
                                            @foreach($syls as $key1 => $sy)
                                                @if($syl->id == $sy->syllabus)
                                                    {{ $selected = 'selected' }}                                                    
                                                @endif
                                            @endforeach
                                            <option value="{{ $syl->id }}" {{ $selected }}>{{ $syl->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('syllabi')
                                    <small class="text-danger">{{ $errors->first('syllabi') }}</small>
                                @enderror
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