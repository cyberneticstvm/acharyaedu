@extends("base")
@section("content")
<div class="banner-text">
    <div class="container">
        <div class="row">
            <div class="col">
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
        </div>
    </div>
</div>
@endsection