@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Exam Register</h3></div>
                    <div class="col text-end"><a href="/admin/exam/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
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
                        <thead><tr><th>SL No</th><th>Exam Name</th><th>Batch</th><th>Cutoff Mark</th><th>Q. count</th><th>Duration</th><th>Exam Date</th><th>Edit</th><th>Delete</th></tr></thead><tbody>
                        @forelse($exams as $key => $exam)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td><a href="/admin/eq/create/{{ $exam->id }}" class="text-primary">{{ $exam->name }}</a></td>
                                <td>{{ $exam->batch->name }}</td>
                                <td>{{ $exam->cut_off_mark }}</td>
                                <td>{{ $exam->question_count }}</td>
                                <td>{{ $exam->duration }} Minutes</td>
                                <td>{{ $exam->exam_date->format('d/M/Y') }}</td>
                                <td class="text-center"><a href="/admin/exam/edit/{{$exam->id}}"><i class="fa fa-pencil text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('exam.delete', $exam->id) }}">
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