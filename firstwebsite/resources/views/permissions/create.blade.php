@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Add New Permission</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('permissions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="e.g., user_create" required>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
