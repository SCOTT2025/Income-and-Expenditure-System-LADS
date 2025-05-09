@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Monthly Reports</h3>

    <form method="GET" action="{{ route('reports.monthly') }}" class="mb-4 d-flex align-items-center gap-2">
        <input type="month" name="month" class="form-control w-auto" value="{{ $month }}">
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Summary -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Income</h5>
                    <p class="card-text fs-5 fw-bold">$ {{ number_format($totalIncome, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-danger shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Expense</h5>
                    <p class="card-text fs-5 fw-bold">$ {{ number_format($totalExpense, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Net Balance</h5>
                    <p class="card-text fs-5 fw-bold">
                        @if($netBalance >= 0)
                            <span class="text-success">$ {{ number_format($netBalance, 2) }}</span>
                        @else
                            <span class="text-danger">$ {{ number_format($netBalance, 2) }}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables -->
    <div class="row">
        <div class="col-md-6">
            <h5>Incomes</h5>
            <table class="table table-bordered table-striped" id="incomeTable">
                <thead class="table-success">
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incomes as $income)
                        <tr>
                            <td>{{ $income->id }}</td>
                            <td>{{ $income->category->name ?? 'N/A' }}</td>
                            <td>{{ $income->entry_date }}</td>
                            <td>{{ number_format($income->amount, 2) }}</td>
                            <td>{{ $income->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <h5>Expenses</h5>
            <table class="table table-bordered table-striped" id="expenseTable">
                <thead class="table-danger">
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->category->name ?? 'N/A' }}</td>
                            <td>{{ $expense->entry_date }}</td>
                            <td>{{ number_format($expense->amount, 2) }}</td>
                            <td>{{ $expense->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script>
    $('#incomeTable, #expenseTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'excelHtml5', className: 'btn btn-success', text: 'Export to Excel' },
            { extend: 'print', className: 'btn btn-secondary', text: 'Print Table' }
        ],
        order: [[2, 'desc']],
        pageLength: 5
    });
</script>
@endpush
