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
                        <thead><tr><th>SL No</th><th>Doc Type</th><th>Title</th><th>Batch</th><th>Subject</th><th>Modules</th><th>View</th><th>Notes</th></tr></thead><tbody>
                        @forelse($downloads as $key => $doc)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $doc->doctype->name }}</td>
                                <td>{{ $doc->title }}</td>
                                <td>{{ $doc->batch->name }}</td>
                                <td>{{ $doc->subject->name }}</td>
                                <td>{{ getAllModules()->whereIn('id', $doc->modules->pluck('module_id'))->pluck('name')->implode(',') }}</td>
                                <td class="text-center"><a href="/student/notes/view/{{encrypt($doc->id)}}">View</a></td>
                                <td>{{ $doc->notes }}</td>
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