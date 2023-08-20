@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Module Status</h3></div>
                </div>                
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
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('module.status.fetch') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="mb-3">
                                    <select class="form-control bforSyl" name="batch">
                                        <option value="">Select Batch</option>
                                        @forelse($batches as $key => $batchh)
                                            <option value="{{ $batchh->id }}" {{ ($batchh->id == $batch) ? 'selected' : '' }}>{{ $batchh->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('batch')
                                    <small class="text-danger">{{ $errors->first('batch') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-submit bg-gradient-primary">FETCH</button>
                        </div>                       
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <h5 class="mb-3">Modules completed in Batch</h5>
                    <form method="post" action="{{ route('module.status.save') }}">
                        @csrf                    
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-light">
                                        <tr><th>SL No</th><th>Module Name</th><th>Subject</th><th>Faculty</th><th>Status</th><th>Remove</th></tr>
                                    </thead>
                                    <tbody>
                                        @php $slno = 1 @endphp
                                        @forelse($modules as $key => $module)
                                        <input type="hidden" name="batch" value="{{ $batch }}" />
                                        <input type="hidden" name="modules[]" value="{{ $module->modules->id }}" />
                                        <tr>
                                            <td>{{ $slno++ }}</td>
                                            <td>{{ $module->modules->name }}</td>
                                            <td>{{ getAllsubjects()->find($module->modules->subject_id)->name }}</td>
                                            <td>
                                                <select class="form-control" name="faculties[]">
                                                    <option value="0">Select</option>
                                                    @forelse($faculties as $key=> $faculty)
                                                    <option value="{{ $faculty->id }}" {{ (($module->faculty) && $module->faculty == $faculty->id) ? 'selected' : '' }}>{{ $faculty->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control" name="statuses[]">
                                                    <option value="0" {{ (($module->status) && $module->status == 0) ? 'selected' : '' }}>Pending</option>
                                                    <option value="1" {{ (($module->status) && $module->status == 1) ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </td>
                                            <td>
                                            
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">UPDATE</button>
                                <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                            </div>
                        </div>
                    </form>
                    <!--<form method="post" action="{{ route('module.complete.delete', $module->id) }}">
                        @csrf 
                        @method("DELETE")
                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
                    </form>-->
                    <h5 class="mb-3">Modules completed in Topic wise Exams</h5>
                    <div class="col"> {{ $topics }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection