@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Student Inactive Reason</h3>
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
                <form role="form" method="post" action="{{ route('student.inactive.reason.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Student ID</label>
                                <div class="mb-3">
                                    <input type="number" class="form-control" name="student_id" value="{{ old('student_id') }}" aria-label="Text" aria-describedby="text-addon" placeholder="Student ID">
                                </div>
                                @error('student_id')
                                    <small class="text-danger">{{ $errors->first('student_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req">Inactive Reason</label>
                                <div class="mb-3">
                                    <textarea class="form-control" name="reason" row="5" value="{{ old('reason') }}" placeholder="Inactive Reason"></textarea>
                                </div>
                                @error('reason')
                                    <small class="text-danger">{{ $errors->first('reason') }}</small>
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
            <div class="card-body">
                <h5>Student Inactive Reason Register</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable-basic">
                        <thead class="thead-light">
                            <tr><th>SL No</th><th>Student Name</th><th>Student ID</th><th>Reason</th><th>Created On</th></tr>
                        </thead>
                        <tbody>
                            @forelse($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->student?->name }}</td>                             
                                <td>{{ $item->student?->id }}</td>                             
                                <td>{{ $item->reason }}</td>                             
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>                         
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
@endsection