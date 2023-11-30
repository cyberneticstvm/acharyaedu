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
                <p><input class="moqr" type="radio" name="moqr" value="" data-ans="A" /> Option A: {!! $question->option_a !!}</p>
                <p><input class="moqr" type="radio" name="moqr" value="" data-ans="B" /> Option B: {!! $question->option_b !!}</p>
                <p><input class="moqr" type="radio" name="moqr" value="" data-ans="C" /> Option C: {!! $question->option_c !!}</p>
                <p><input class="moqr" type="radio" name="moqr" value="" data-ans="D" /> Option D: {!! $question->option_d !!}</p>
                <br />
                <p class="hidden show text-success">Correct Answer: <span class="correct_answer">{{ albhabets()[$question->correct_option] }}</span></p>
                <p class="hidden show">Explanaton: {!! $question->explanation !!}</p>
                @empty
                @endforelse
                {!! $questions->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection