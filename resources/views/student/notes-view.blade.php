@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">{{ $note->title }}</h3></div>
                </div>                
            </div>
            <div class="card-body">
                {!! $note->description !!}
            </div>
        </div>
    </div>
</div>
@endsection