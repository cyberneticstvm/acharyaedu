@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">SCERT Question Register</h3></div>
                    <div class="col text-end"><a href="/admin/scertquestion/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
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
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Level</th><th>Subject</th><th>Chapter</th><th>Count</th><th>View</th></tr></thead><tbody>
                        @forelse($questions as $key => $question)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ subjectLevels()->find($question->level_id)->name }}</td>
                                <td>{{ $question->subject?->name }}</td>
                                <td>{{ $question->chapter?->name }}</td>
                                <td>{{ $question->qcount }}</td>
                                <td><a href="{{ route('scertquestion.show', ['level' => $question->level_id, 'subject' => $question->subject_id, 'chapter' => $question->chapter_id]) }}">Questions</a></td>
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