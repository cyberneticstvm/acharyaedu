@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Free Exam Scheduler</h3></div>
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
                <form method="post" action="{{ route('student.freeexam.create') }}">
                    @csrf
                    <div class="row g-2">                            
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="req mb-1">Subject</label>
                                <select class="form-control subject" data-random="5" name="subject_id">
                                    <option value="">Select</option>
                                    @forelse(studentsubjects() as $key => $subject)
                                        <option value="{{ $subject->id }}" {{ ($inputs && $inputs[0] == $subject->id) ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                            @error('subject_id')
                                <small class="text-danger">{{ $errors->first('subject_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label class="req">Exam Date</label>
                            <input type="date" class="form-control" name="exam_date" value="{{ ($inputs && $inputs[1]) ? $inputs[1] : old('exam_date') }}">
                            @error('exam_date')
                                <small class="text-danger">{{ $errors->first('exam_date') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-5">
                            <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">Create Exam</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Exam Name</th><th>Batch</th><th>Exam Date</th><th>Correct</th><th>Wrong</th><th>Unattended</th><th>Score</th><th>Grade</th><th class="text-center">Answer</th><th>Performance</th><th class="text-center">Take</th></tr></thead>
                            <tbody>
                            @forelse($exams as $key => $exam)
                            @php $se = getStudentScore(Auth::user()->student->id, $exam->id, $type='free') @endphp
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $exam->name }}</td>
                                <td>Na</td>
                                <td>{{ $exam->exam_date->format('d/M/Y') }}</td>
                                <td>{{ ($se) ? $se->correct_answer_count : 0 }}</td>
                                <td>{{ ($se) ? $se->wrong_answer_count : 0 }}</td>
                                <td>{{ ($se) ? $se->unattended_count : 0 }}</td>
                                <td>{{ ($se) ? $se->total_mark_after_cutoff: 0 }}</td>
                                <td>{{ ($se) ? $se->grade : 0 }}</td>
                                <td class="text-center"><a target="_blank" href="/student/exam/result/{{ ($se) ? encrypt($se->id) : encrypt(0) }}/free"><i class="fa fa-eye text-info"></a></td>
                                <td class="text-center"><a href="/student/exam/performance/{{ ($se) ? encrypt($se->id) : encrypt(0) }}/free"><i class="fa fa-line-chart text-success"></i></a></td>
                                @if(!isStudentAttended(Auth::user()->student->id, $exam->id, $type='free'))
                                <td class="text-center">{!! ($exam->exam_date->format('d/M/Y') == date('d/M/Y')) ? "<a href='/student/exam/$exam->id/free'>Take Exam</a>" : '' !!}</td>
                                @else
                                <td></td>
                                @endif
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