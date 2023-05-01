@extends("admin.base")
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
                            <div id="smartwizard1">
                                <ul class="nav d-none">
                                    @forelse($exam->scores as $key => $quest)
                                    <li class="nav-item">
                                        <a class="nav-link" href="#step-{{$quest->id}}">
                                            <div class="num"></div>
                                            {{ $quest->question->question }}
                                        </a>
                                    </li>
                                    @empty
                                    @endforelse
                                </ul>                            
                                <div class="tab-content">
                                    @php $c = 1;  $color = ""; @endphp
                                    @forelse($exam->scores as $key => $quest)
                                    <div id="step-{{$quest->id}}" class="tab-pane quest" role="tabpanel" aria-labelledby="step-{{$quest->id}}">
                                        Question {!! $c++.'. '. nl2br($quest->question->question) !!}<br><br>
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
                                        <div class="row">
                                            <div class="col">
                                                <button data-bs-toggle="collapse" data-bs-target="#correctanswer{{$quest->id}}" class="btn btn-primary">Show Correct Answer</button>
                                            </div>
                                            <div class="col">
                                                <button data-bs-toggle="collapse" data-bs-target="#explanation{{$quest->id}}" class="btn btn-primary pull-right">Show Explanation</button>                                               
                                            </div>
                                        </div>                                                                               
                                    </div>                                
                                    @empty
                                    @endforelse
                                </div>
                                @forelse($exam->scores as $key => $quest)
                                <div class="row">
                                    <div class="col">
                                        <div class="text-success answer quest collapse mt-1 p-3" id="correctanswer{{$quest->id}}">
                                            {!! $quest->question->options()->where('option_id', $quest->question->correct_option)->value('option_name') !!}
                                        </div>
                                        <div class="text-dark answer quest collapse mt-1 p-3" id="explanation{{$quest->id}}">
                                            {!! ($quest->question->explanation) ? $quest->question->explanation : 'Explanation will be added soon.' !!}
                                        </div>
                                    </div>
                                </div>
                                @empty
                                @endforelse
                                <!-- Include optional progressbar HTML -->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection