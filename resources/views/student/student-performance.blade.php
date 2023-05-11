@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div id="form-messages">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-primary">{{ Auth::user()->student->name }}'s Performance</h5>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div id="studPerfChartAll"></div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection