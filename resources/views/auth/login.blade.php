@extends('layouts.app')

@section('content')
<style>
/* Modern Login Styles - Inspired by Stripe, Linear, Vercel */
.login-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.login-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/></g></g></svg>') repeat;
    opacity: 0.3;
}

.login-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 3rem;
    width: 100%;
    max-width: 480px;
    box-shadow: 
        0 20px 25px -5px rgba(0, 0, 0, 0.1),
        0 10px 10px -5px rgba(0, 0, 0, 0.04),
        0 0 0 1px rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    position: relative;
    z-index: 1;
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.login-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.login-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    letter-spacing: -0.025em;
}

.login-subtitle {
    color: #6b7280;
    font-size: 1rem;
    font-weight: 400;
}

.form-floating-custom {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-control-custom {
    width: 100%;
    padding: 1rem 1.25rem;
    padding-top: 1.75rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.2s ease;
    background: #ffffff;
    color: #1a1a1a;
}

.form-control-custom:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.form-control-custom::placeholder {
    color: transparent;
}

.form-label-custom {
    position: absolute;
    top: 50%;
    left: 1.25rem;
    transform: translateY(-50%);
    color: #6b7280;
    font-size: 1rem;
    pointer-events: none;
    transition: all 0.2s ease;
    background: #ffffff;
    padding: 0 0.25rem;
}

.form-control-custom:focus + .form-label-custom,
.form-control-custom:not(:placeholder-shown) + .form-label-custom {
    top: 0;
    font-size: 0.75rem;
    color: #667eea;
    font-weight: 500;
}

.form-control-custom.is-invalid {
    border-color: #ef4444;
}

.form-control-custom.is-invalid:focus {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.invalid-feedback-custom {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: block;
    animation: shake 0.3s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.checkbox-custom {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.checkbox-input-custom {
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #e5e7eb;
    border-radius: 6px;
    margin-right: 0.75rem;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    appearance: none;
    background: #ffffff;
}

.checkbox-input-custom:checked {
    background: #667eea;
    border-color: #667eea;
}

.checkbox-input-custom:checked::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: bold;
}

.checkbox-label-custom {
    color: #4b5563;
    font-size: 0.875rem;
    cursor: pointer;
    user-select: none;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.btn-primary-custom {
    width: 100%;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.3);
}

.btn-primary-custom:active {
    transform: translateY(0);
}

.btn-link-custom {
    color: #667eea;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    text-align: center;
    transition: color 0.2s ease;
}

.btn-link-custom:hover {
    color: #764ba2;
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 640px) {
    .login-container {
        padding: 1rem;
    }
    
    .login-card {
        padding: 2rem;
        border-radius: 16px;
    }
    
    .login-title {
        font-size: 1.75rem;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .login-card {
        background: rgba(30, 30, 30, 0.95);
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .login-title {
        color: #ffffff;
    }
    
    .form-control-custom {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }
    
    .form-label-custom {
        color: #9ca3af;
        background: rgba(30, 30, 30, 0.95);
    }
    
    .form-control-custom:focus + .form-label-custom {
        color: #667eea;
    }
}
</style>

<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h1 class="login-title">{{ __('Welcome Back') }}</h1>
            <p class="login-subtitle">{{ __('Sign in to your account to continue') }}</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div class="form-floating-custom">
                <input 
                    id="email" 
                    type="email" 
                    class="form-control-custom @error('email') is-invalid @enderror" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="Email Address"
                    required 
                    autocomplete="email" 
                    autofocus
                >
                <label for="email" class="form-label-custom">{{ __('Email Address') }}</label>
                
                @error('email')
                    <span class="invalid-feedback-custom">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-floating-custom">
                <input 
                    id="password" 
                    type="password" 
                    class="form-control-custom @error('password') is-invalid @enderror" 
                    name="password" 
                    placeholder="Password"
                    required 
                    autocomplete="current-password"
                >
                <label for="password" class="form-label-custom">{{ __('Password') }}</label>
                
                @error('password')
                    <span class="invalid-feedback-custom">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="checkbox-custom">
                <input 
                    type="checkbox" 
                    name="remember" 
                    id="remember" 
                    class="checkbox-input-custom"
                    {{ old('remember') ? 'checked' : '' }}
                >
                <label for="remember" class="checkbox-label-custom">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary-custom">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="btn-link-custom">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
