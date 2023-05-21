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
    <div class="col-md-3">
        <div class="form-group">
            <label class="req mb-1">Module Name</label>
            <select class="form-control module" name="topic_id">
                <option value="">Select</option>
                
            </select>                                  
        </div>
        @error('topic_id')
            <small class="text-danger">{{ $errors->first('topic_id') }}</small>
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
    <div class="col-md-3">
        <div class="form-group">
            <label class="req mb-1">Month</label>
            <select class="form-control" name="month">
                @forelse($months as $key => $month)
                    <option value="{{ $month->id }}">{{ $month->name }}</option>
                @empty
                @endforelse
            </select>                                  
        </div>
        @error('month')
            <small class="text-danger">{{ $errors->first('month') }}</small>
        @enderror
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="req mb-1">Year</label>
            <select class="form-control" name="year">
                @for($i=2020; $i<=date('Y'); $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>                                  
        </div>
        @error('year')
            <small class="text-danger">{{ $errors->first('year') }}</small>
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