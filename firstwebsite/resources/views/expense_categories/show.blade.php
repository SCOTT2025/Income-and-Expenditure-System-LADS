@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Expense Category Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $expenseCategory->name }}</h5>
            <p class="card-text"><strong>Created:</strong> {{ $expenseCategory->created_at->format('d M Y') }}</p>
            <p class="card-text"><strong>Updated:</strong> {{ $expenseCategory->updated_at->format('d M Y') }}</p>
        </div>
    </div>

    <a href="{{ route('expense-categories.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
