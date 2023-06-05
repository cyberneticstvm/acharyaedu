<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="req mb-1">Subject Name</label>
            <select class="form-control subject" name="subject_id" data-random="0">
                <option value="">Select</option>
                @forelse($subjects as $key => $subject)
                    <option value="{{ $subject->id }}" {{ ($subject->id == old('subject_id')) ? 'selected' : '' }}>{{ $subject->name }}</option>
                @empty
                @endforelse
            </select>                                  
        </div>
        @error('subject_id')
            <small class="text-danger">{{ $errors->first('subject_id') }}</small>
        @enderror
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label class="req mb-1">Module Name</label>
            <select class="form-control select2" name="topic_id[]" multiple>
                @forelse(getAllModules() as $key => $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                @empty
                @endforelse
            </select>                                  
        </div>
        @error('topic_id')
            <small class="text-danger">{{ $errors->first('topic_id') }}</small>
        @enderror
    </div>
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