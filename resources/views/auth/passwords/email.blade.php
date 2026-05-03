@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<style>
.forgot-password-page {
    min-height: calc(100vh - 0px);
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #0f172a 0%, #1d4ed8 45%, #38bdf8 100%);
    padding: 3rem 1rem;
}

.forgot-password-card {
    width: 100%;
    max-width: 520px;
    padding: 2.5rem;
    border-radius: 32px;
    background: rgba(15, 23, 42, 0.92);
    border: 1px solid rgba(255, 255, 255, 0.12);
    box-shadow: 0 32px 80px rgba(15, 23, 42, 0.35);
    color: #e2e8f0;
    backdrop-filter: blur(18px);
}

.forgot-password-card h1 {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
    color: #ffffff;
}

.forgot-password-card p {
    margin-bottom: 1.75rem;
    color: rgba(226, 232, 240, 0.82);
    line-height: 1.75;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    margin-bottom: 0.75rem;
    color: #cbd5e1;
    font-weight: 700;
}

.form-control {
    width: 100%;
    padding: 1rem 1.1rem;
    border-radius: 18px;
    border: 1px solid rgba(148, 163, 184, 0.2);
    background: rgba(255, 255, 255, 0.08);
    color: #f8fafc;
    transition: all 0.25s ease;
}

.form-control:focus {
    outline: none;
    border-color: #60a5fa;
    box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.14);
    background: rgba(255, 255, 255, 0.12);
}

.btn-reset {
    width: 100%;
    padding: 1rem 1.2rem;
    border: none;
    border-radius: 999px;
    background: #38bdf8;
    color: #0f172a;
    font-weight: 700;
    font-size: 1rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 30px rgba(56, 189, 248, 0.28);
}

.forgot-footer {
    margin-top: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 0.75rem;
    color: rgba(226, 232, 240, 0.72);
    flex-wrap: wrap;
}

.forgot-footer a {
    color: #93c5fd;
    text-decoration: none;
}

.forgot-footer a:hover {
    color: #ffffff;
}

.alert-custom {
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    border-radius: 18px;
    background: rgba(56, 189, 248, 0.12);
    border: 1px solid rgba(56, 189, 248, 0.24);
    color: #dbeafe;
}

.invalid-feedback {
    color: #fecdd3;
    margin-top: 0.5rem;
    display: block;
    font-size: 0.95rem;
}

@media (max-width: 768px) {
    .forgot-password-card {
        padding: 2rem;
    }
    .forgot-password-card h1 {
        font-size: 1.75rem;
    }
}
</style>

<div class="forgot-password-page">
    <div class="forgot-password-card">
        <div class="mb-4">
            <h1>Reset your password</h1>
            <p>Enter the email address associated with your account, and we’ll send a secure link to reset your password.</p>
        </div>

        @if (session('status'))
            <div class="alert-custom" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn-reset">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>

        <div class="forgot-footer">
            <span>Remembered your password?</span>
            <a href="{{ route('login') }}">Return to login</a>
        </div>
    </div>
</div>
@endsection
