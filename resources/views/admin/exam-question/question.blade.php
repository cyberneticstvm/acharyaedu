@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Create Exam Questions</h3></div>
                    <div class="col text-end"><h3 class="font-weight-bolder text-primary text-gradient">Exam Name: {{ $exam->name }}</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <form method="post" action="{{ route('eq.save') }}">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}" >
                        <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                            <thead><tr><th class="d-none"></th><th>SL No</th><th>Question</th><th>Remove</th></tr></thead><tbody>
                            @forelse($questions as $key => $question)
                                <tr>
                                    <td class="d-none"><input type="hidden" name="questions[]" value="{{ $question->id }}"></td>
                                    <td>{{ $slno++ }}</td>
                                    <td>{!! $question->question !!}</td>
                                    <td class="text-center">
                                        @if($slno != 1)<a href="javascript:void(0)"><i class="fa fa-trash text-danger" onclick="javascript: $(this).closest('tr').remove();"></i></a>@endif
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody></table>
                        <div class="col-12 mt-3 text-center">
                            <button type="submit" class="btn btn-submit btn-primary text-uppercase fs-6">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection