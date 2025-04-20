@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Expense Details</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Category:</strong> {{ $expense->category->name }}</p>
            <p><strong>Date:</strong> {{ $expense->entry_date }}</p>
            <p><strong>Amount:</strong> {{ $expense->amount }}</p>
            <p><strong>Description:</strong> {{ $expense->description }}</p>
        </div>
    </div>

    <a href="{{ route('expenses.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
