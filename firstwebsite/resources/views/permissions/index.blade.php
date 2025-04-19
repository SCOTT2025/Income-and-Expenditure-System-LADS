@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Permission List</h3>

    <a href="{{ route('permissions.create') }}" class="btn btn-success mb-3">Add Permission</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="permissionsTable">
                <thead>
                    <tr>
                        <th width="10">
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <input type="checkbox" class="row-checkbox" value="{{ $permission->id }}">
                            </td>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-sm btn-primary">View</a>
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-danger mt-3" id="bulk-delete">Delete selected</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(function () {
        $('#permissionsTable').DataTable();

        $('#select-all').click(function () {
            $('.row-checkbox').prop('checked', this.checked);
        });

        $('#bulk-delete').click(function () {
            const selected = $('.row-checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            if (selected.length === 0) {
                alert('Select at least one permission to delete.');
                return;
            }

            if (confirm('Are you sure to delete selected permissions?')) {
                $.ajax({
                    url: '{{ route("permissions.bulkDelete") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ids: selected
                    },
                    success: function (res) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
@endpush
