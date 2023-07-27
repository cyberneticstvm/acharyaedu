@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Update Current Affair Question</h3>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{ route('caffair.update', $caffair->id) }}">
                    @csrf
                    @method("PUT")
                    <div class="row">                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req">Question</label>
                                <textarea class="form-control" name="question" placeholder="Question">{{ $caffair->question }}</textarea>                                    
                            </div>
                            @error('question')
                                <small class="text-danger">{{ $errors->first('question') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="req">Answer</label>
                                <textarea class="form-control" name="answer" placeholder="Answer">{{ $caffair->answer }}</textarea>                                    
                            </div>
                            @error('answer')
                                <small class="text-danger">{{ $errors->first('answer') }}</small>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="">Explanation</label>
                                <textarea class="form-control" name="explanation" placeholder="Explanation">{{ $caffair->explanation }}</textarea>                                    
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="mb-3">
                                    <input type="date" class="form-control" name="date" value="{{ $caffair->date->format('Y-m-d') }}" aria-label="Date" aria-describedby="date-addon">
                                </div>
                                @error('date')
                                    <small class="text-danger">{{ $errors->first('date') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">UPDATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection