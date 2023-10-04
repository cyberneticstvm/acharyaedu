@extends("admin.base")
@section("content")
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header pb-0 text-left bg-transparent">
                <div class="row">
                    <div class="col"><h3 class="font-weight-bolder text-primary text-gradient">Student Register</h3></div>
                </div>                
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('student.batch.save') }}">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="datatable-basic">
                            <thead class="thead-light">
                                <tr><th>SL No</th><th>Student ID</th><th>Student Name</th><th>Mobile</th><th>Admission Date</th><th>Fee Paid Months</th></tr>
                            </thead>
                            <tbody>
                                @php $slno = 1 @endphp
                                @forelse($students as $key => $student)
                                <tr>
                                    <td>{{ $slno++ }}</td>
                                    <td>{{ $student->studentname->id }}</td>
                                    <td>{{ $student->studentname->name }}</td>                                    
                                    <td>{{ $student->studentname->mobile }}</td>
                                    <td>{{ $student->studentname->admission_date?->format('d, M Y') }}</td>
                                    <td><a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="{!! getFeePendingDetails($student->studentname->id) !!}">View</a></td>                                    
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection