@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="row">
                    <div class="col-md-12"><h5 class="text-primary">{{ $student->name }}'s Downloads</h5></div>
                </div>
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        @php $slno = 1; @endphp
                            <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                            <thead><tr><th>SL No</th><th>Doc Type</th><th>Title</th><th>Batch</th><th>Subject</th><th>Modules</th><th>Attachment</th><th>Notes</th></tr></thead><tbody>
                            @forelse($downloads as $key => $doc)
                                <tr>
                                    <td>{{ $slno++ }}</td>
                                    <td>{{ $doc->doctype->name }}</td>
                                    <td>{{ $doc->title }}</td>
                                    <td>{{ $doc->batch->name }}</td>
                                    <td>{{ $doc->subject->name }}</td>
                                    <td>{{ getAllModules()->whereIn('id', $doc->modules->pluck('module_id'))->pluck('name')->implode(',') }}</td>
                                    <td class="text-center"><a href="{{ asset('storage/'.$doc->attachment) }}" target="_blank">Attachment</a></td>
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
</div>
@endsection