@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Student Performance</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('studentperformanceall.get') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
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
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">FETCH</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                    <thead><tr><th>SL No</th><th>Exam Name</th><th>Batch</th><th>Cutoff Mark</th><th>Q. count</th><th>Duration</th><th>Exam Date</th></tr></thead><tbody>
                        @php $slno = 1; @endphp
                        @forelse($exams as $key => $exam)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td><a class="text-primary" href="/admin/student/performance/exam/{{$exam->id}}">{{ $exam->name }}</a></td>
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
@endsection