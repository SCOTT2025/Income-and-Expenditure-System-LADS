@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Add Expense</h3>

    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="expense_category_id" class="form-label">Expense Category</label>
            <select name="expense_category_id" class="form-select" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="entry_date" class="form-label">Entry Date</label>
            <input type="date" name="entry_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
