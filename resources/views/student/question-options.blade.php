@extends("student.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">{!! $question->question !!}</h5></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            @php $c = 1; @endphp
                            @forelse($question->options as $key => $option)
                                {!! albhabets()[$c++].'. '.$option->option_name !!}<br><br>
                            @empty
                            @endforelse
                        </div>
                        <div class="col-md-12">
                            Correct Answer: <span class="text-success"> {!! $question->options()->where('option_id', $question->correct_option)->value('option_name') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection