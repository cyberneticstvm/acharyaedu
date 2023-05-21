<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label class="req mb-1">Number of questions</label>
            <input type="number" class="form-control" name="number_of_questions" max="{{ $max }}" value="{{ old('number_of_questions') }}" placeholder="0">                                    
        </div>
        @error('nummber_of_questions')
            <small class="text-danger">{{ $errors->first('nummber_of_questions') }}</small>
        @enderror
    </div>
</div>