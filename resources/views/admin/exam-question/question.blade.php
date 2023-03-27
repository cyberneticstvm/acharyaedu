@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                @php 
                    $slno = 1;
                @endphp
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Exam Questions</h5></div>
                        <div class="col text-end">Exam Name: <span class="text-primary">{{ $exam->name }}</span></i></a></div>
                    </div>                    
                    <form method="post" action="{{ route('eq.save') }}">
                        @csrf
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}" >
                        <table id="datatable-basic" class="table table-sm table-bordered">
                            <thead><tr><th class="d-none"></th><th>SL No</th><th>Question</th><th>Remove</th></tr></thead><tbody>
                            @forelse($questions as $key => $question)
                                <tr>
                                    <td class="d-none"><input type="hidden" name="questions[]" value="{{ $question->id }}"></td>
                                    <td>{{ $slno++ }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td class="text-center">
                                        @if($slno != 2)<a href="javascript:void(0)"><i class="fa fa-trash text-danger" onclick="javascript: $(this).closest('tr').remove();"></i></a>@endif
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