@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div id="form-messages">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4"><h5 class="text-primary">{{ (Auth::user()) ? Auth::user()->student->name : '' }}</h5></div>
                    <div class="col-md-4"><h5 class="text-primary">{{ $exam->name }} / Number of Quests. {{ $exam->questions->count('id') }}</h5></div>
                    <div class="col-md-4"><h5 class="text-primary">Time Remaining: {{ $exam->duration }} / <span class="text-danger" id="time-remain">{{ $exam->duration }}</span> (<span id="secs" class="text-success"></span>) Minutes</h5></div>
                </div>
                <form method="post" action="{{ route('student.exam.save', [$exam->id, $type]) }}" id="frmExam">
                    @csrf
                    <input type="hidden" id="exam-time-duration" value="{{ $exam->duration }}" />
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div id="smartwizard">
                                <ul class="nav d-none">
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
                                    <div id="step-{{$quest->id}}" class="tab-pane quest" role="tabpanel" aria-labelledby="step-{{$quest->id}}">
                                        Question {!! $c++.'. '. nl2br($quest->question->question) !!}<br><br>
                                        @forelse($quest->question->options as $key1 => $option)
                                            {{$option->option_id}}&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="rad_{{$quest->id}}" value="{{ $option->option_id }}" class="radanswer" data-chk="rad_{{$quest->id}}" >&nbsp;&nbsp;{!! $option->option_name !!}<br><hr>
                                        @empty
                                        @endforelse
                                    </div>
                                    @empty
                                    @endforelse
                                </div>                            
                                <!-- Include optional progressbar HTML -->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">fgdf</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12"><h5>Question Attended Status</h5></div>
                                    @php $c = 1 @endphp
                                    @forelse($exam->questions as $key => $quest)
                                    <div class="col text-center unattended rad_{{$quest->id}}"><a href="javascript:void(0)">{{$c++}}</a></div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>  
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection