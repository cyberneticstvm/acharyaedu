@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Module Register</h3></div>
                    <div class="col text-end"><a href="/admin/topic/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
                </div>                
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
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('course.module.save') }}">
                    @csrf
                    <div class="table-responsive">
                        @php $slno = 1; @endphp
                        <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                            <thead><tr><th>SL No</th><th>Module Name</th><th>Subject</th><th>Question Count</th><th>Select</th><th>Edit</th></tr></thead><tbody>
                            @forelse($topics as $key => $topic)
                                <tr>
                                    <td>{{ $slno++ }}</td>
                                    <td><a href="/admin/module/questions/{{$topic->id}}" target="_blank" class="text-primary">{{ $topic->name }}</a></td>
                                    <td>{{ $topic->subject->name }}</td>
                                    <td>{{ $topic->questions->count() }}</td>
                                    <td class="text-center"><input type="checkbox" name="modules[]" value="{{ $topic->id }}" /></td>
                                    <td class="text-center"><a href="/admin/topic/edit/{{$topic->id}}"><i class="fa fa-pencil text-warning"></i></a></td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody></table>
                    </div>
                    <div class="row mt-5">
                        @error('modules')
                            <small class="text-danger">{{ $errors->first('modules') }}</small>
                        @enderror
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req">Course</label>
                                <div class="mb-3">
                                    <select class="form-control select2" name="course[]" multiple>
                                        <option value="">Select</option>
                                        @forelse($courses as $key => $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('course')
                                    <small class="text-danger">{{ $errors->first('course') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-submit btn-primary btn-md">Assign</button>
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