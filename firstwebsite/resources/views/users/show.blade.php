@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">User Details</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Roles:</strong>
                @foreach($user->roles as $role)
                    <span class="badge bg-primary">{{ $role->name }}</span>
                @endforeach
            </p>

            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
