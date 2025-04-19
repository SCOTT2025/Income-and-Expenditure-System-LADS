@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role Details</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $role->name }}</h5>
            <p class="card-text">
                <strong>Permissions:</strong><br>
                @foreach($role->permissions as $permission)
                    <span class="badge bg-info text-dark">{{ $permission->name }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
