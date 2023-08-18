@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Revision Register</h3></div>
                    <div class="col text-end"><a href="/admin/revision/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
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
                @csrf
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Title</th><th>Modules</th><th>Subject</th><th>Batches</th><th>Status</th><th>Date</th><th>Edit</th><th>Delete</th></tr></thead><tbody>
                        @forelse($revisions as $key => $revision)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $revision->title }}</td>
                                <td>{{ getAllModules()->whereIn('id', $revision->modules->pluck('module_id'))->pluck('name')->implode(',') }}</td>
                                <td>{{ ($revision->subject) ? $revision->subject->name : '' }}</td>
                                <td>{{ getActiveBatches()->whereIn('id', $revision->batches->pluck('batch_id'))->pluck('name')->implode(',') }}</td>
                                <td>{{ ($revision->status == 0) ? 'Pending' : 'Completed' }}</td>
                                <td>{{ $revision->date->format('d/M/Y') }}</td>
                                <td class="text-center"><a href="/admin/revision/edit/{{encrypt($revision->id)}}"><i class="fa fa-pencil text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('revision.delete', $revision->id) }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection