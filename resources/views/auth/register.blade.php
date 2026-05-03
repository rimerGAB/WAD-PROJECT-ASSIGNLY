@extends('layouts.app')

@section('content')
<style>
/* Modern Register Styles - Identical to Login */
.register-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.register-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23ffffff" fill-opacity="0.05"><path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/></g></g></svg>') repeat;
    opacity: 0.3;
}

.register-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 3rem;
    width: 100%;
    max-width: 520px;
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

.register-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.register-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 0.5rem;
    letter-spacing: -0.025em;
}

.register-subtitle {
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

.password-strength {
    margin-top: 0.5rem;
    font-size: 0.75rem;
    color: #6b7280;
}

.password-strength-indicator {
    height: 4px;
    background: #e5e7eb;
    border-radius: 2px;
    margin-top: 0.25rem;
    overflow: hidden;
}

.password-strength-bar {
    height: 100%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.password-strength-bar.weak {
    width: 33%;
    background: #ef4444;
}

.password-strength-bar.medium {
    width: 66%;
    background: #f59e0b;
}

.password-strength-bar.strong {
    width: 100%;
    background: #10b981;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 2rem;
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

.login-link {
    text-align: center;
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e5e7eb;
}

.login-link-text {
    color: #6b7280;
    font-size: 0.875rem;
}

.login-link-text a {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.login-link-text a:hover {
    color: #764ba2;
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 640px) {
    .register-container {
        padding: 1rem;
    }
    
    .register-card {
        padding: 2rem;
        border-radius: 16px;
        max-width: 100%;
    }
    
    .register-title {
        font-size: 1.75rem;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .register-card {
        background: rgba(30, 30, 30, 0.95);
        border-color: rgba(255, 255, 255, 0.1);
    }
    
    .register-title {
        color: #ffffff;
    }
    
    .register-subtitle {
        color: #9ca3af;
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
    
    .login-link {
        border-top-color: rgba(255, 255, 255, 0.1);
    }
    
    .login-link-text {
        color: #9ca3af;
    }
}
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h1 class="register-title">{{ __('Create Account') }}</h1>
            <p class="register-subtitle">{{ __('Join us today and get started') }}</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf

            <div class="form-floating-custom">
                <input 
                    id="name" 
                    type="text" 
                    class="form-control-custom @error('name') is-invalid @enderror" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="Full Name"
                    required 
                    autocomplete="name" 
                    autofocus
                >
                <label for="name" class="form-label-custom">{{ __('Name') }}</label>
                
                @error('name')
                    <span class="invalid-feedback-custom">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

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
                    autocomplete="new-password"
                >
                <label for="password" class="form-label-custom">{{ __('Password') }}</label>
                
                @error('password')
                    <span class="invalid-feedback-custom">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <div class="password-strength" id="passwordStrength" style="display: none;">
                    <div class="password-strength-text">Password strength: <span id="strengthText">Weak</span></div>
                    <div class="password-strength-indicator">
                        <div class="password-strength-bar" id="strengthBar"></div>
                    </div>
                </div>
            </div>

            <div class="form-floating-custom">
                <input 
                    id="password-confirm" 
                    type="password" 
                    class="form-control-custom" 
                    name="password_confirmation" 
                    placeholder="Confirm Password"
                    required 
                    autocomplete="new-password"
                >
                <label for="password-confirm" class="form-label-custom">{{ __('Confirm Password') }}</label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary-custom">
                    {{ __('Register') }}
                </button>
            </div>
        </form>

        <div class="login-link">
            <p class="login-link-text">
                {{ __('Already have an account?') }} 
                <a href="{{ route('login') }}">{{ __('Sign in') }}</a>
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password-confirm');
    const passwordStrength = document.getElementById('passwordStrength');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    function checkPasswordStrength(password) {
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]+/)) strength++;
        if (password.match(/[A-Z]+/)) strength++;
        if (password.match(/[0-9]+/)) strength++;
        if (password.match(/[$@#&!]+/)) strength++;
        
        return strength;
    }
    
    function updatePasswordStrength() {
        const password = passwordInput.value;
        
        if (password.length === 0) {
            passwordStrength.style.display = 'none';
            return;
        }
        
        passwordStrength.style.display = 'block';
        const strength = checkPasswordStrength(password);
        
        strengthBar.className = 'password-strength-bar';
        
        if (strength <= 2) {
            strengthBar.classList.add('weak');
            strengthText.textContent = 'Weak';
            strengthText.style.color = '#ef4444';
        } else if (strength <= 3) {
            strengthBar.classList.add('medium');
            strengthText.textContent = 'Medium';
            strengthText.style.color = '#f59e0b';
        } else {
            strengthBar.classList.add('strong');
            strengthText.textContent = 'Strong';
            strengthText.style.color = '#10b981';
        }
    }
    
    function checkPasswordMatch() {
        if (passwordConfirmInput.value && passwordInput.value !== passwordConfirmInput.value) {
            passwordConfirmInput.classList.add('is-invalid');
        } else {
            passwordConfirmInput.classList.remove('is-invalid');
        }
    }
    
    passwordInput.addEventListener('input', updatePasswordStrength);
    passwordConfirmInput.addEventListener('input', checkPasswordMatch);
});
</script>
@endsection
