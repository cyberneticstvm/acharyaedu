@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Current Affairs Register</h3></div>
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
            <!-- <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatable-basic">
                        <thead class="thead-light">
                            <tr><th>SL No</th><th>Question</th><th>Answer</th><th>Explanation</th><th>Date</th></tr>
                        </thead>
                        <tbody>
                            @php $slno = 1 @endphp
                            @forelse($caffairs as $key => $caffair)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $caffair->question }}</td>
                                <td>{{ $caffair->answer }}</td>
                                <td>{{ $caffair->explanation }}</td>
                                <td>{{ $caffair->date->format('d/M/Y') }}</td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div> -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @php($c=1)
                        @forelse($caffairs as $key => $caffair)
                            <div class="mb-1">
                                {{$c++}}: {{ $caffair->question }}
                            </div>
                            <div class="mb-1">
                                Ans: {{ $caffair->answer }}
                            </div>
                            <div class="mb-1">
                                Exp: {{ $caffair->explanation }}
                            </div>
                            <hr>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection