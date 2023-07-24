@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Slider Register</h3></div>
                    <div class="col text-end"><a href="/slider/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">CREATE</a></div>
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
                    <table class="table table-striped table-bordered" id="datatable-basic">
                        <thead class="thead-light">
                            <tr><th>SL No</th><th>Title</th><th>Slider Image</th><th>Edit</th><th>Remove</th></tr>
                        </thead>
                        <tbody>
                            @php $slno = 1 @endphp
                            @forelse($sliders as $key => $slider)
                            <tr>
                                <td>{{ $slno++ }}</td>
                                <td>{{ $slider->title }}</td>
                                <td class="text-center"><a href="/storage/sliders/{{ $slider->image }}" target="_blank"><i class="fa fa-image text-info"></i></a></td>
                                <td class="text-center"><a href="/slider/edit/{{ encrypt($slider->id) }}"><i class="fa fa-edit text-warning"></i></a></td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('slider.delete', $slider->id) }}">
                                        @csrf 
                                        @method("DELETE")
                                        <button type="submit" class="border no-border" onclick="javascript: return confirm('Are you sure want to delete this record?');"><i class="fa fa-trash text-danger"></i></button>
                                    </form>
                                </td>
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