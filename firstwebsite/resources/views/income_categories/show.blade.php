@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Income Category Details</h3>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $income_category->id }}</p>
            <p><strong>Name:</strong> {{ $income_category->name }}</p>
            <a href="{{ route('income_categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
