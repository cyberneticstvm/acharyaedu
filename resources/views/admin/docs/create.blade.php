@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-primary text-gradient">Create Doc</h3>
            </div>
            <div class="card-body">
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
                <form role="form" method="post" action="{{ route('docs.save') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
                                </div>
                                @error('title')
                                    <small class="text-danger">{{ $errors->first('title') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Batch</label>
                                <div class="mb-3">
                                    <select class="form-control" name="batch_id">
                                        <option value="">Select</option>
                                        @forelse($batches as $key => $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('batch_id')
                                    <small class="text-danger">{{ $errors->first('batch_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="req">Subject</label>
                                <div class="mb-3">
                                    <select class="form-control" name="subject_id">
                                        <option value="">Select</option>
                                        @forelse($subjects as $key => $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('subject_id')
                                    <small class="text-danger">{{ $errors->first('subject_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="mb-1">Attachment</label>
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="attachment" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="req mb-1">Modules</label>
                                <select class="form-control select2" name="modules[]" data-placeholder="Select Multiple if required" multiple>
                                    @forelse($modules as $key => $module)
                                        <option value="{{ $module->id }}">{{ $module->name }}</option>
                                    @empty
                                    @endforelse
                                </select>                                  
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="">Notes</label>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="notes" value="{{ old('notes') }}" placeholder="Notes" />
                                </div>
                                @error('notes')
                                    <small class="text-danger">{{ $errors->first('notes') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="req">Document type</label>
                                <div class="mb-3">
                                    <select class="form-control" name="document_type">
                                        <option value="">Select</option>
                                        @forelse($doctypes as $key => $doc)
                                            <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                @error('document_type')
                                    <small class="text-danger">{{ $errors->first('document_type') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="">Description</label>
                                <div class="mb-3">
                                    <textarea rows="5" class="form-control" name="description"  placeholder="Description">{{ $doc->description }}</textarea>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-submit bg-gradient-primary mt-4 mb-0">CREATE</button>
                        <button type="button" onclick="history.back()" class="btn bg-gradient-warning mt-4 mb-0">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection