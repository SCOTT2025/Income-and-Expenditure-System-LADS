@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Create Expense Category</h2>

    <form action="{{ route('expense-categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('expense-categories.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

