<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="req mb-1">Subject Name</label>
            <select class="form-control subject" name="subject_id" data-random="0">
                <option value="">Select</option>
                @forelse($subjects->where('exam_type', 2) as $key => $subject)
                    <option value="{{ $subject->id }}" {{ ($subject->id == old('subject_id')) ? 'selected' : '' }}>{{ $subject->name }}</option>
                @empty
                @endforelse
            </select>                                  
        </div>
        @error('subject_id')
            <small class="text-danger">{{ $errors->first('subject_id') }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="req mb-1">Chapter Name</label>
            <select class="form-control" name="chapter">
                <option value="">Select</option>
                @forelse($chapters as $key => $chapter)
                    <option value="{{ $chapter->id }}" {{ ($chapter->id == old('chapter')) ? 'selected' : '' }}>{{ $subject->name }}</option>
                @empty
                @endforelse
            </select>                                  
        </div>
        @error('chapter')
            <small class="text-danger">{{ $errors->first('chapter') }}</small>
        @enderror
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="req mb-1">Level Name</label>
            <select class="form-control select2" name="level_id[]" multiple data-placeholder="Select">
                <option value="">Select</option>
                @forelse($levels as $key => $level)
                    <option value="{{ $level->id }}" {{ ($level->id == old('level_id')) ? 'selected' : '' }}>{{ $level->name }}</option>
                @empty
                @endforelse
            </select>                                  
        </div>
        @error('level_id')
            <small class="text-danger">{{ $errors->first('level_id') }}</small>
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