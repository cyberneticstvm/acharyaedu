@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Batch Register</h3></div>
                    <div class="col text-end"><a href="/batch/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
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
                            <tr><th>SL No</th><th>Batch ID</th><th>Batch Name</th><th>Active</th><th>Inactive</th><th>Total</th><th>Course Name</th><th>Fee</th><th>Status</th><th>Edit</th><th>Remove</th></tr>
                        </thead>
                        <tbody>
                            @php $slno = 1 @endphp
                            @forelse($batches as $key => $batch)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $batch->id }}</td>                             
                                <td>{{ $batch->name }}</td>
                                <td class="text-end"><a href="/student/{{$batch->id}}/0" class="text-success">{{ $batch->studentbatches()->where('cancelled', 0)->count('id') }}</a></td>
                                <td class="text-end"><a href="/student/{{$batch->id}}/1" class="text-danger">{{ $batch->studentbatches()->where('cancelled', 1)->count('id') }}</a></td>
                                <td class="text-end text-info">{{ $batch->studentbatches()->count('id') }}</td>                             
                                <td>{{ getAllCourses()->whereIn('id', $batch->courses->pluck('course_id'))->pluck('name')->implode(',') }}</td>                             
                                <!--<td>{{ $syllabus->whereIn('id', $batch->batchsyllabi()->pluck('syllabus'))->pluck('name')->implode(',') }}</td>-->                             
                                <td>{{ $batch->fee }}</td>
                                <td>{{ ($batch->status == 1) ? 'Active' : 'Expired' }}</td>                             
                                <td class="text-center"><a href="/batch/edit/{{ $batch->id }}"><i class="fa fa-edit text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('batch.delete', $batch->id) }}">
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