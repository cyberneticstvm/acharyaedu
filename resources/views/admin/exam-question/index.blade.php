@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Exam Question Register</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Exam</th><th>Question</th><th>Delete</th></tr></thead><tbody>
                        @forelse($eqs as $key => $eq)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $eq->exam->name }}</td>
                                <td>{!! $eq->question->question !!}</td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('eq.delete', $eq->id) }}">
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
                <div class="text-center">
                    <a type="button" href="/admin/exam" class="btn bg-gradient-warning mt-4 mb-0">Back to Exam Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection