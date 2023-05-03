@extends("student.base")
@section("content")
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-primary text-center">{{ Auth::user()->student->name }}'s Performance</h5>
                        </div>
                        <div class="col-md-3 mt-5"></div>
                        <div class="col-md-6 mt-5">
                            <div id="studPerfChartAll"></div>
                        </div>
                        <div class="col-md-3 mt-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection