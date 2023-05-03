@extends("student.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Student Performance</h5></div>
                    </div>
                    <form method="post" action="{{ route('student.studymaterials.fetch') }}">
                        @csrf
                        <div class="row g-2">                            
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="req mb-1">Subject</label>
                                    <select class="form-control subject" data-random="5" name="subject_id">
                                        <option value="">Select</option>
                                        @forelse($subjects as $key => $subject)
                                            <option value="{{ $subject->id }}" {{ ($inputs && $inputs[0] == $subject->id) ? 'selected' : '' }}>{{ $subject->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>                                  
                                </div>
                                @error('subject_id')
                                    <small class="text-danger">{{ $errors->first('subject_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="req mb-1">Module Name</label>
                                    <select class="form-control module" name="module_id">
                                        <option value="">Select</option>
                                        @forelse($modules->random(($modules->count() >= 5) ? 5 : $modules->count() ) as $key => $module)
                                            <option value="{{ $module->id }}" {{ ($inputs && $inputs[1] == $module->id) ? 'selected' : '' }}>{{ $module->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>                                  
                                </div>
                                @error('module_id')
                                    <small class="text-danger">{{ $errors->first('module_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-12 mt-3 text-end">
                                <button type="button" onclick="javascript:window.history.back();" class="btn btn-danger text-uppercase fs-6">Cancel</button>
                                <button type="submit" class="btn btn-submit btn-primary text-uppercase fs-6">Fetch</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <table id="datatable-basic" class="table table-sm table-bordered">
                        <thead><tr><th>SL No</th><th>Question</th><th>View</th></tr></thead><tbody>
                            @php $slno = 1; @endphp
                            @forelse($questions as $key => $question)
                                <tr>
                                    <td>{{ $slno++ }}</td>
                                    <td class="quest">{!! $question->question !!}</td>
                                    <td class="text-center"><a target="_blank" href="/student/question/{{ $question->id }}"><i class="fa fa-eye text-info"></a></td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection