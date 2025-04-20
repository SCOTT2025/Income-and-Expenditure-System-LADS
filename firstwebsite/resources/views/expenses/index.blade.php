@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Expense List</h3>

    <div class="d-flex mb-3 gap-2">
        <a href="{{ route('expenses.create') }}" class="btn btn-success">Add Expense</a>
        <button class="btn btn-danger" id="bulk-delete">Delete selected</button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="expensesTable">
                <thead>
                    <tr>
                        <th width="10"><input type="checkbox" id="select-all"></th>
                        <th>ID</th>
                        <th>Expense Category</th>
                        <th>Entry Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                        <tr>
                            <td>
                                <input type="checkbox" class="row-checkbox" value="{{ $expense->id }}">
                            </td>
                            <td>{{ $expense->id }}</td>
                            <td>{{ $expense->category?->name ?? '-' }}</td> <!-- ✅ Corrected line -->
                            <td>{{ $expense->entry_date }}</td>
                            <td>{{ number_format($expense->amount, 2) }}</td>
                            <td>{{ $expense->description }}</td>
                            <td>
                                <a href="{{ route('expenses.show', $expense->id) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables & Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Buttons functionality -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script>
    $(function () {
        let table = $('#expensesTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    className: 'btn btn-info'
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    className: 'btn btn-danger'
                },
                {
                    extend: 'print',
                    text: 'Print',
                    className: 'btn btn-secondary'
                },
                {
                    extend: 'colvis',
                    text: 'Column visibility',
                    className: 'btn btn-outline-dark'
                }
            ],
            order: [[1, 'asc']],
            columnDefs: [
                { orderable: false, targets: [0, 6] }
            ]
        });

        $('#select-all').on('click', function () {
            $('.row-checkbox').prop('checked', this.checked);
        });

        $('#bulk-delete').on('click', function () {
            const selected = $('.row-checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            if (selected.length === 0) {
                alert('Select at least one expense to delete.');
                return;
            }

            if (confirm('Are you sure to delete selected expenses?')) {
                $.ajax({
                    url: '{{ route("expenses.bulkDelete") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ids: selected
                    },
                    success: function () {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endpush
