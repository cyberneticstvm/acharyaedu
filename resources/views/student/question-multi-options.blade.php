@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bolder text-primary text-gradient">Multiple Options Question Register</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @forelse($questions as $key => $question)
                <p>Question: {!! $question->question !!}</p>
                <p>Subject: {{ $question->subject->name }}</p>
                <br />
                <p>Option A: {!! $question->option_a !!}</p>
                <p>Option B: {!! $question->option_b !!}</p>
                <p>Option C: {!! $question->option_c !!}</p>
                <p>Option D: {!! $question->option_d !!}</p>
                <br />
                <p>Correct Answer: {{ $question->correct_option }}</p>
                <p>Explanaton: {!! $question->explanation !!}</p>
                @empty
                @endforelse
                {!! $questions->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection