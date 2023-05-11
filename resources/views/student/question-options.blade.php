@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div id="form-messages">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">{!! $question->question !!}</h5></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 quest">
                            @php $c = 1; @endphp
                            @forelse($question->options as $key => $option)
                                {!! albhabets()[$c++].'. '.$option->option_name !!}<br><br>
                            @empty
                            @endforelse
                        </div>
                        <div class="col-md-12 quest">
                            Correct Answer: <span class="text-success"> {!! $question->options()->where('option_id', $question->correct_option)->value('option_name') !!}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection