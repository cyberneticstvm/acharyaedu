@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col">
                        <h3 class="font-weight-bolder text-primary text-gradient">Question Options Register</h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @forelse($questions as $key => $question)
                <p>Question: {!! $question->question !!}</p>
                <p>Subject: {{ $question->subject->name }}</p>
                <br />
                @forelse($question->options as $key1 => $item)
                <p><input class="moqr" type="radio" name="moqr" value="" data-ans="{{ albhabets()[$item->option_id] }}" /> Option A: {!! $item->option_name !!}</p>
                @empty
                @endforelse
                <br />
                <p class="hidden show text-success">Correct Answer: <span class="correct_answer">{{ albhabets()[$question->correct_option] }}</span></p>
                <div class="hidden show">Explanaton: {!! $question->explanation !!}</div>
                @empty
                @endforelse
                {!! $questions->withQueryString()->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection