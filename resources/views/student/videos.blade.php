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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="req">Subject</label>
                            <div class="mb-3">
                                <select class="form-control vidSubject" name="subject_id">
                                    <option value="">Select</option>
                                    @forelse(getAllSubjects() as $key => $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            @error('subject_id')
                                <small class="text-danger">{{ $errors->first('subject_id') }}</small>
                            @enderror
                        </div>
                    </div>
                    @forelse($videos as $key => $video)
                        <div class="col-md-3 subFilter" data-cls = "sub_{{$video->subject_id}}">
                            <h5 class="color-primary"><a href="javascript:void(0)" title="{{ $video->title }}">{{ Str::limit($video->title, 20) }}</a></h5>
                            <a class="popup-youtube" href="https://youtube.com/watch?v={{$video->video_id}}"><img src="https://img.youtube.com/vi/{{$video->video_id}}/hqdefault.jpg" class="img-fluid rounded" /></a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection