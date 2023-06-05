@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Class Schedule Register</h3></div>
                    <div class="col text-end"><a href="/cschedule/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable-basic">
                        <thead class="thead-light">
                            <tr><th>SL No</th><th>Date</th><th>Batch</th><th>Subject</th><th>Faculty</th><th>Time</th><th>Notes</th><th>Type</th><th>Edit</th><th>Remove</th></tr>
                        </thead>
                        <tbody>
                            @php $slno = 1 @endphp
                            @forelse($classes as $key => $class)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $class->class_date->format('d/M/Y') }}</td>                             
                                <td>{{ $class->batch->name }}</td>                             
                                <td>{{ $class->subject->name }}</td>
                                <td>{{ $class->faculty->name }}</td>
                                <td>{{ $class->class_time }}</td>
                                <td>{{ $class->notes }}</td>
                                <td>{{ ($class->type == 0) ? 'Online' : 'Offline' }}</td>
                                <td class="text-center"><a href="/cschedule/edit/{{ encrypt($class->id) }}"><i class="fa fa-edit text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('cschedule.delete', $class->id) }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </td>
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