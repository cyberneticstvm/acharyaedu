@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Gallery Register</h3></div>
                    <div class="col text-end"><a href="/admin/gallery/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
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
                <div class="table-responsive">
                @php $slno = 1; @endphp
                    <table id="datatable-basic" class="table table-sm table-striped table-bordered">
                        <thead><tr><th>SL No</th><th>Gallery Type</th><th>Title</th><th>Attachment</th><th>Edit</th><th>Delete</th></tr></thead><tbody>
                        @forelse($docs as $key => $doc)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $doc->type }}</td>
                                <td>{{ $doc->title }}</td>
                                <td class="text-center"><a href="{{ asset('storage/'.$doc->attachment) }}" target="_blank">{{ ($doc->attachment) ? 'Attachment' : '' }}</a></td>
                                <td class="text-center"><a href="/admin/gallery/edit/{{encrypt($doc->id)}}"><i class="fa fa-pencil text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('gallery.delete', $doc->id) }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection