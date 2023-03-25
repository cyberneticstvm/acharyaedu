@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Topic Register</h5></div>
                        <div class="col text-end"><a href="/admin/topic/create"><i class="fa fa-plus fw-bold fa-lg text-primary"></i></a></div>
                    </div>
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-bordered">
                        <thead><tr><th>SL No</th><th>Topic Name</th><th>Subject</th><th>Edit</th><th>Delete</th></tr></thead><tbody>
                        @forelse($topics as $key => $topic)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $topic->name }}</td>
                                <td>{{ $topic->subject->name }}</td>
                                <td class="text-center"><a href="/admin/topic/edit/{{$topic->id}}"><i class="fa fa-pencil text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('topic.delete', $topic->id) }}">
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