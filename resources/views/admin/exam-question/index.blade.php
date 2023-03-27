@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Exam Question Register</h5></div>
                    </div>
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-bordered">
                        <thead><tr><th>SL No</th><th>Exam</th><th>Question</th><th>Delete</th></tr></thead><tbody>
                        @forelse($eqs as $key => $eq)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $eq->exam->name }}</td>
                                <td>{{ $eq->question->question }}</td>
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
            </div>
        </div>
    </div>
</div>
@endsection