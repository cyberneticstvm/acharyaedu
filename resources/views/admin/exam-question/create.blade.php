@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Create Exam Questions</h3></div>
                    <div class="col text-end"><h3 class="font-weight-bolder text-primary text-gradient">Exam Name: {{ $exam->name }}</h3></div>
                </div>
            </div>
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success text-white">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger text-white">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <form role="form" method="post" action="{{ route('eq.create', $exam->id) }}">
                    @csrf
                    @if($exam->exam_type == 1)
                        @include("admin.exam-question.exams.general")
                    @endif
                    @if($exam->exam_type == 2)
                        @include("admin.exam-question.exams.scert")
                    @endif
                    @if($exam->exam_type == 3)
                        @include("admin.exam-question.exams.previous")
                    @endif
                    @if($exam->exam_type == 4)
                        @include("admin.exam-question.exams.model")
                    @endif
                    @if($exam->exam_type == 5)
                        @include("admin.exam-question.exams.caffair")
                    @endif
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">GENERATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection