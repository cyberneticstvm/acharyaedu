@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">{{ $student->name }}'s Notes</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Title</th><th>Modules</th><th>Date</th><th>Revision No</th><th>Status</th></tr></thead><tbody>
                        @forelse($revisions as $key => $doc)
                            <tr class="{{ ($doc->date->format('Y-m-d') > date('Y-m-d')) ? 'text-danger' : 'text-success' }}">
                                <td>{{ $slno++ }}</td>
                                <td>{{ $doc->title }}</td>
                                <td>{{ getAllModules()->whereIn('id', $doc->modules->pluck('module_id'))->pluck('name')->implode(',') }}</td>
                                <td>{{ $doc->date->format('d-M-Y') }}</td>
                                <td>{{ $doc->revision_no }}</td>
                                <td>{{ ($doc->status == 0) ? 'Active' : 'Completed' }}</td>
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