@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bolder text-primary text-gradient">General Question Register</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th>SL No</th>
                                <th>Subject</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Explanation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $slno = 1 @endphp
                            @forelse($questions as $key => $question)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $question->subject->name }}</td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->answer }}</td>
                                <td>{{ $question->explanation }}</td>
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