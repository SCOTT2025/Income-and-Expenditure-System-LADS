@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">User List</h3>

    <div class="d-flex mb-3 gap-2">
        <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>
        <button class="btn btn-danger" id="bulk-delete">Delete selected</button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="usersTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Email verified at</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><input type="checkbox" class="row-checkbox" value="{{ $user->id }}"></td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->email_verified_at }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge bg-info text-dark">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
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
<!-- Include DataTables & jQuery (same as Permissions) -->
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
        $('#usersTable').DataTable({
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
                alert('Select at least one user to delete.');
                return;
            }

            if (confirm('Are you sure to delete selected users?')) {
                $.ajax({
                    url: '{{ route("users.bulkDelete") }}',
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
