@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">Edit Income</h3>

    <form action="{{ route('incomes.update', $income->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="income_category_id" class="form-label">Income Category</label>
            <select name="income_category_id" id="income_category_id" class="form-select" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $income->income_category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="entry_date" class="form-label">Entry Date</label>
            <input type="date" name="entry_date" id="entry_date" value="{{ $income->entry_date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" value="{{ $income->amount }}" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ $income->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('incomes.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
