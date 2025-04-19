@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Roles</h1>

    <a href="{{ route('roles.create') }}" class="btn btn-success mb-3">+ Add Role</a>

    <table class="table table-bordered table-striped" id="roles-table">
        <thead>
            <tr>
                <th width="10"><input type="checkbox" id="select-all"></th>
                <th>Title</th>
                <th>Permissions</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(function () {
    let table = $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('roles.index') }}',
        columns: [
            { data: 'id', render: function(data) {
                return `<input type="checkbox" class="row-checkbox" value="${data}">`;
            }, orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'permissions', name: 'permissions', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    $('#select-all').on('click', function () {
        $('.row-checkbox').prop('checked', this.checked);
    });
});
</script>
@endpush
