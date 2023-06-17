@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">{{ $student->name }}'s Videos</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($videos as $key => $video)
                        <div class="col-md-3">
                                <h5 class="color-primary">{{ $video->title }}</h5>
                                <a class="popup-youtube" href="https://youtube.com/watch?v={{$video->video_id}}"><img src="https://img.youtube.com/vi/{{$video->video_id}}/hqdefault.jpg" class="img-fluid" /></a>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection