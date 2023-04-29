@extends("admin.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive table-sm table-striped">
                    <div class="row">
                        <div class="col"><h5 class="text-primary">Student Performance</h5></div>
                    </div>
                    <form method="post" action="{{ route('studentperformanceall.get') }}">
                        @csrf
                        <div class="row g-2">                            
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="req mb-1">Batch</label>
                                    <select class="form-control" name="batch_id">
                                        <option value="">Select</option>
                                        @forelse($batches as $key => $b)
                                            <option value="{{ $b->id }}" {{ ($batch && $batch->id == $b->id) ? 'selected' : '' }}>{{ $b->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>                                  
                                </div>
                                @error('batch_id')
                                    <small class="text-danger">{{ $errors->first('batch_id') }}</small>
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
                        <thead><tr><th>SL No</th><th>Exam Name</th><th>Batch</th><th>Cutoff Mark</th><th>Q. count</th><th>Duration</th><th>Exam Date</th></tr></thead><tbody>
                            @php $slno = 1; @endphp
                            @forelse($exams as $key => $exam)
                                <tr>
                                    <td>{{ $slno++ }}</td>
                                    <td><a href="/admin/student/performance/exam/{{$exam->id}}">{{ $exam->name }}</a></td>
                                    <td>{{ $exam->batch->name }}</td>
                                    <td>{{ $exam->cut_off_mark }}</td>
                                    <td>{{ $exam->question_count }}</td>
                                    <td>{{ $exam->duration }}</td>
                                    <td>{{ $exam->exam_date->format('d/m/Y') }}</td>
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