@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Add Income Category</h3>
    <form action="{{ route('income_categories.store') }}" method="POST">
        @csrf
        @include('income_categories.form', [
            'buttonText' => 'Create',
            'income_category' => new \App\Models\IncomeCategory
        ])
    </form>
</div>
@endsection
