@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Income List</h3>

    <div class="d-flex mb-3 gap-2">
        <a href="{{ route('incomes.create') }}" class="btn btn-success">Add Income</a>
        <button class="btn btn-danger" id="bulk-delete">Delete selected</button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="incomeTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>ID</th>
                        <th>Income Category</th>
                        <th>Entry Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incomes as $income)
                        <tr>
                            <td><input type="checkbox" class="row-checkbox" value="{{ $income->id }}"></td>
                            <td>{{ $income->id }}</td>
                            <td>{{ $income->category->name ?? 'N/A' }}</td>
                            <td>{{ $income->entry_date }}</td>
                            <td>{{ number_format($income->amount, 2) }}</td>
                            <td>{{ $income->description }}</td>
                            <td>
                                <a href="{{ route('incomes.show', $income->id) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" class="d-inline">
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
    $(function () {
        let table = $('#incomeTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Export to Excel',
                    className: 'btn btn-success'
                },
                {
                    extend: 'print',
                    text: 'Print Table',
                    className: 'btn btn-secondary'
                }
            ],
            order: [[1, 'desc']],
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
                alert('Select at least one income to delete.');
                return;
            }

            if (confirm('Are you sure to delete selected incomes?')) {
                $.ajax({
                    url: '{{ route("incomes.bulkDelete") }}',
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
