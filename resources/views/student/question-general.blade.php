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
                @forelse($questions as $key => $question)
                <p>Question: {{ $question->question }}</p>
                <p>Subject: {{ $question->subject->name }}</p>
                <p>Subject: {{ $question->answer }}</p>
                <p>Subject: {{ $question->explanation }}</p>
                @empty
                @endforelse
                {!! $questions->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>
@endsection