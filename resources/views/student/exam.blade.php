@extends("student.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"><h5 class="text-primary">{{ Auth::user()->name }}</h5></div>
                        <div class="col-md-4"><h5 class="text-primary text-center">{{ $exam->name }}</h5></div>
                        <div class="col-md-4"><h5 class="text-primary text-end">Time Remaining: {{ $exam->duration }} / <span class="text-danger" id="time-remain">{{ $exam->duration }}</span> Minutes</h5></div>
                    </div>
                    <form method="post" action="{{ route('student.exam.save', $exam->id) }}" id="frmExam">
                        @csrf
                        <input type="hidden" id="exam-time-duration" value="{{ $exam->duration }}" />
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div id="smartwizard que">
                                    <ul class="nav">
                                        @forelse($exam->questions as $key => $quest)
                                        <li class="nav-item">
                                            <a class="nav-link" href="#step-{{$quest->id}}">
                                                <div class="num"></div>
                                                {{ $quest->question->question }}
                                                <input type="hidden" name="questions[]" value="{{ $quest->question->id }}" />
                                            </a>
                                        </li>
                                        @empty
                                        @endforelse
                                    </ul>                            
                                    <div class="tab-content">
                                        @php $c = 1 @endphp
                                        @forelse($exam->questions as $key => $quest)
                                        <div id="step-{{$quest->id}}" class="tab-pane" role="tabpanel" aria-labelledby="step-{{$quest->id}}">
                                            Question {{ $c++.'. '.$quest->question->question }}<br><br>
                                            @forelse($quest->question->options as $key1 => $option)
                                                {{$option->option_id}}&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="rad_{{$quest->id}}" value="{{ $option->option_id }}">&nbsp;&nbsp;{{ $option->option_name }}<br><hr>
                                            @empty
                                            @endforelse
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>                            
                                    <!-- Include optional progressbar HTML -->
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection