<!DOCTYPE html>
<html>

<head>
    <title>Acharya Educations</title>
    <style>
        table {
            border: 1px solid #e6e6e6;
            font-size: 12px;
        }

        thead {
            border-bottom: 1px solid #e6e6e6;
        }

        table thead th,
        table tbody td {
            padding: 5px;
            font-size: 1rem;
            border: 1px solid #000;
        }

        .bordered td {
            border: 1px solid #e6e6e6;
        }

        .text-right {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <img src="./assets/images/acharya.jpg" width="100%" /><br />
    </center>
    <br />
    <p class="text-center">Fee Pending Report</p>
    <h5 class="text-center">Batch: {{ $batch->name }}, Month: {{ $monthname }}, Year: {{ $year }}</h5>
    <table width="100%" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Mobile</th>
                <th>Fee</th>
                <th>Balance</th>
                <th>Paid Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $key => $record)
            @php $fee = $record->studentname()->find($record->student)->batchFee()->where('fee_month', $month)->where('fee_year', $year)->where('batch', $batch->id) @endphp
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $record->studentname()->find($record->student)->name }}</td>
                <td>{{ $record->studentname()->find($record->student)->id }}</td>
                <td>{{ $record->studentname()->find($record->student)->mobile }}</td>
                <td>{{ $fee->value('fee') }}</td>
                <td>{{ $fee->value('fee_balance') }}</td>
                <td>{{ ($fee->value('paid_date')) ? date('d/M/Y', strtotime($fee->value('paid_date'))) : '' }}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</body>

</html>