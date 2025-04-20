@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h3 class="mb-4">View Income</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $income->id }}</p>
            <p><strong>Category:</strong> {{ $income->category->name }}</p>
            <p><strong>Entry Date:</strong> {{ $income->entry_date }}</p>
            <p><strong>Amount:</strong> ${{ number_format($income->amount, 2) }}</p>
            <p><strong>Description:</strong> {{ $income->description ?? '-' }}</p>
        </div>
    </div>

    <a href="{{ route('incomes.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection
