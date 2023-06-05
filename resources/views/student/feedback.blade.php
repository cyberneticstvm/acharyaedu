@extends("student.base")
@section("content")
<div class="rts-contact-page-form-area rts-section-gapTop">
    <div class="container-fluid">
        <div class="row">
            <div class="mian-wrapper-form">
                <div class="row">
                    <div class="col-md-12"><h5 class="text-primary">Feedback</h5></div>
                </div>
                <div id="form-messages">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-6">
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
                                    <button type="submit" class="rts-btn btn-primary btn-submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12 table-responsive">
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
</div>
@endsection