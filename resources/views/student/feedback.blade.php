@extends("student.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Feedback</h3></div>
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
                <form method="post" action="{{ route('student.feedback.save') }}">
                    @csrf
                    <div class="row g-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req mb-1">Feedback</label>
                                <textarea class="form-control" name="feedback" placeholder="Feedback"></textarea>                                   
                            </div>
                            @error('feedback')
                                <small class="text-danger">{{ $errors->first('feedback') }}</small>
                            @enderror
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-submit bg-gradient-primary mb-0">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Feedback</th><th>Date</th></tr></thead>
                            <tbody>
                            @forelse($feedbacks as $key => $feed)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $feed->feedback }}</td>
                                <td>{{ $feed->created_at->format('d/M/Y') }}</td>
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