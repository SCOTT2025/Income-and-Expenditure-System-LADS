@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow-sm" style="min-width: 350px;">
        <h3 class="text-center mb-4">Log in to your account</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Enter your email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required placeholder="Enter password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </form>

        <div class="mt-3 text-center">
            <small>Don't have an account? <a href="{{ route('register') }}">Sign up now</a></small>
        </div>
    </div>
</div>
@endsection
