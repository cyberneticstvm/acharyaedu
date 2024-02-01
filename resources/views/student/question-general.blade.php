@extends("student.base")
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
                @forelse($questions as $key => $question)
                <p>Subject: {{ $question->subject->name }}</p>
                <p>Question: {{ $question->question }}</p>
                <p><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false">Show Answer</a></p>
                <div class="collapse" id="collapseExample">Answer: {{ $question->answer }}</div>
                <p>Explanation: {{ $question->explanation }}</p>
                @empty
                @endforelse
                {!! $questions->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection