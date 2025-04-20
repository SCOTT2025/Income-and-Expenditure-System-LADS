@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Expense</h3>

    <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="expense_category_id" class="form-label">Expense Category</label>
            <select name="expense_category_id" class="form-select" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $cat->id == $expense->expense_category_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="entry_date" class="form-label">Entry Date</label>
            <input type="date" name="entry_date" class="form-control" value="{{ $expense->entry_date }}" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $expense->amount }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $expense->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Expense</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
