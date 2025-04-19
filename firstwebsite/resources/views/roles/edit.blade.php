@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Role</h3>

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Role Title</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Assign Permissions</label>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                id="perm_{{ $permission->id }}"
                                {{ $role->permissions->contains('name', $permission->name) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
