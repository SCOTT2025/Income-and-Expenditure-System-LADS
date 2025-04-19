@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Role: {{ $role->name }}</h3>

    <div class="mb-3">
        <strong>Permissions:</strong><br>
        @foreach($role->permissions as $permission)
            <span class="badge bg-info text-dark mb-1">{{ $permission->name }}</span>
        @endforeach
    </div>

    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
