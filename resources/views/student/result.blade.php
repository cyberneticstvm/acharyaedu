@extends("student.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3"><h5 class="text-primary text-center">{{ $student->name }}'s Exam Result</h5></div>
                        <div class="col-md-4"><h5 class="text-primary">Exam Name: {{ $exam->exam->name }}</h5></div>
                        <div class="col-md-2"><h5 class="text-primary">Total Qustns.: {{ $exam->exam->question_count }}</h5></div>
                        <div class="col-md-2"><h5 class="text-primary">Correct: {{ $exam->correct_answer_count }}</h5></div>
                        <div class="col-md-2"><h5 class="text-primary">Wrong: {{ $exam->wrong_answer_count }}</h5></div>
                        <div class="col-md-2"><h5 class="text-primary">Unattended: {{ $exam->unattended_count }}</h5></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <ol class="mt-3">
                            @forelse($exam->scores as $key => $quest)
                                <li>
                                    {!! nl2br($quest->question->question) !!}<br>
                                    @forelse($quest->question->options as $key1 => $opt)
                                        @php $color = ""; @endphp
                                        @if($quest->correct_option == $opt->option_id && $quest->selected_option == $quest->question->correct_option)
                                            @php $color = "text-success"; @endphp
                                        @elseif($quest->selected_option == $opt->option_id && $quest->selected_option != $quest->question->correct_option)
                                            @php $color = "text-danger"; @endphp                                           
                                        @endif                                        
                                        <span class="{{ $color }}">{!! nl2br($opt->option_name) !!}</span><br>
                                        <hr>
                                    @empty
                                    @endforelse
                                </li>
                            @empty
                            @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection