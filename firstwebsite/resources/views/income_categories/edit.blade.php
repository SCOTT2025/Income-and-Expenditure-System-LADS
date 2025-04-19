@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Income Category</h3>
    <form action="{{ route('income_categories.update', $income_category->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('income_categories.form', [
            'buttonText' => 'Update',
            'income_category' => $income_category
        ])
    </form>
</div>
@endsection
