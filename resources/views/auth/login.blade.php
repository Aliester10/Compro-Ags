@extends('layouts.Member.master3')

@section('content')
<div class="login-container">
    <!-- Background image with overlay -->
    <div class="bg-overlay" style="background-image: url('{{ asset('assets/img/login-bg.png') }}');"></div>
    
    <!-- Header -->
    <div class="header">
        <h1>PT Arkamaya Guna Saharsa</h1>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="content-wrapper">
            <!-- Left Column - Branding -->
            <div class="left-section">
                <div class="brand-content">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/img/AGS Logo-01.png') }}" alt="AGS Logo" class="logo-image">
                    </div>
                    
                    <div class="brand-message">
                        <h2>LET'S MAKE<br>AWESOME<br>WORK TOGETHER.</h2>
                        <p>Partner With Us And Turn Your Vision Into<br>Meaningful Results.</p>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Login Form -->
            <div class="right-section">
                <div class="glass-form">
                    <div class="form-content">
                        <div class="form-header">
                            <h3>Email</h3>
                        </div>
                        
                        @if(session('error'))
                            <div class="error-alert fade-in">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" 
                                    class="form-input @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                                    placeholder="Enter Your Email">
                                @error('email')
                                    <p class="error-text">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <div class="form-label">
                                    <label for="password">Password</label>
                                </div>
                                <input id="password" type="password" 
                                    class="form-input @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password" 
                                    placeholder="••••••">
                                @error('password')
                                    <p class="error-text">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                                
                                <div class="forgot-password">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-button">
                                <button type="submit" class="btn-signin">
                                    SIGN IN
                                </button>
                            </div>
                        </form>
                        
                        <div class="divider">
                            <span>Or</span>
                        </div>
                        
                        <div class="register-links">
                            <p>New Here? Sign Up To Become A <a href="{{ route('distributors.register') }}" class="register-link">Distributor</a></p>
                            <p>Create one as an <a href="{{ route('enduser.register') }}?type=end-user" class="register-link">End User</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Home Button -->
        <div class="home-button">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/icons/home.svg') }}" width="21" height="21" alt="Home Icon">
                <span>Home</span>
            </a>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    @import url('/assets/css/fonts.css');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Work Sans', sans-serif;
    }
    
    body, html {
        height: 100%;
        margin: 0;
        overflow-x: hidden;
    }
    
    /* Main Container */
    .login-container {
        position: relative;
        width: 100vw;
        height: 100vh;
        overflow: hidden;
    }
    
    /* Background Image and Overlay */
    .bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: -1;
    }
    
    /* Header Styling */
    .header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 7.5px 0;
        background: linear-gradient(to right,rgba(110, 110, 110, 0), #FFFFFF);
        z-index: 10;
        text-align: center;
        height: 33px;
    }
    
    .header h1 {
        font-size: 17px;
        font-weight: 600;
        color: #000000;
        margin: 0;
        font-family: 'work sans', sans-serif;
        letter-spacing: -0.02em; /* 8% letter spacing */

    }
    
    /* Main Content Layout */
    .main-content {
        position: relative;
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    /* Content wrapper for centering */
    .content-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 90%;
        max-width: 1200px;
        height: auto;
        min-height: 500px;
        position: relative;
    }
    
    /* Left Side Section */
    .left-section {
        width: 50%;
        height: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0 15px;
    }
    
    .brand-content {
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: center;
    }
    
    /* Logo and branding */
    .brand-logo {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    
    /* Logo image styling */
    .logo-image {
        width: 198px;
        height: auto;
        max-width: 100%;
        margin-top: -40px;
        margin-bottom: -30px;
    }
    
    .brand-message {
        margin-top: 30px;
    }
    
    .brand-message h2 {
        font-size: 48px;
        font-weight: 700;
        color: white;
        line-height: 1.1;
        margin: 0 0 10px 0;
        letter-spacing: -2.2%;
        line-height: 103%;
        font-family: 'Work Sans', sans-serif;
    }
    
    .brand-message p {
        font-size: 20px;
        color: white;
        margin: 0;
        font-weight: 400;
        line-spacing: -2.2%;
        line-height: 120%;
        font-family: 'Work Sans', sans-serif;
    }
    
    /* Right Side Section */
    .right-section {
        width: 50%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 15px;
    }
    
    /* Glass Effect Form */
    .glass-form {
        width: 100%;
        max-width: 450px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 10px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }
    
    .form-content {
        padding: 30px;
    }
    
    .form-header {
        margin-bottom: 15px;
    }
    
    .form-header h3 {
        font-size: 16px;
        font-weight: 400;
        color: white;
        font-family: 'work sans', sans-serif;
    }
    
    /* Form Elements */
    .form-group {
        margin-bottom: 24px;
        width: 100%;
    }
    
    .form-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .form-group label {
        font-size: 16px;
        font-weight: 400;
        color: white;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 16px;
        background-color: white;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-family: 'work sans', sans-serif;
        outline: none;
        height: 42px;
    }
    
    .form-input:focus {
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }
    
    .is-invalid {
        border: 1px solid #f56565;
    }
    
    .error-text {
        color: #fca5a5;
        font-size: 14px;
        margin-top: 4px;
    }
    
    .forgot-password {
        text-align: right;
        margin-top: 8px;
    }
    
    .forgot-password a {
        font-size: 14px;
        color: white;
        text-decoration: underline;
        font-family: 'work sans', sans-serif;
        font-weight: 300;
    }
    
    /* Sign In Button */
    .form-button {
        margin-top: 20px;
        text-align: center;
    }
    
    .btn-signin {
        width: 100%;
        max-width: 193px;
        background-color: #2196F3;
        color: white;
        font-weight: 500;
        padding: 5px 5px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.2s;
        font-size: 14px;
        letter-spacing: 1px;
        height: 32px;
    }
    
    .btn-signin:hover {
        background-color: #1976D2;
    }
    
    /* Divider */
    .divider {
        display: flex;
        align-items: center;
        text-align: center;
        color: white;
        margin: 20px 0;
    }
    
    .divider:before,
    .divider:after {
        content: "";
        flex: 1;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .divider:before {
        margin-right: 16px;
    }
    
    .divider:after {
        margin-left: 16px;
    }
    
    .divider span {
        font-size: 14px;
    }
    
    /* Register Links */
    .register-links {
        text-align: center;
        font-size: 14px;
    }
    
    .register-links p {
        color: white;
        margin: 6px 0;
    }
    
    .register-link {
        color: white;
        text-decoration: underline;
        font-weight: 400;
        font-family: 'work sans', sans-serif;
    }
    
    /* Home Button */
    .home-button {
        position: absolute;
        bottom: 42px;
        left: 70px;
    }
    
    .home-button a {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: white;
        text-decoration: none;
        font-size: 17px;
        line-height: 120%;
        letter-spacing: -2.2%;
        font-family: 'work sans', sans-serif;
        font-weight: 300;
    }
    
    .home-button svg {
        margin-bottom: 4px;
    }
    
    .home-button span {
        font-weight: 300;
    }
    
    /* Error Alert */
    .error-alert {
        background-color: rgba(254, 226, 226, 0.9);
        border: 1px solid #fca5a5;
        color: #b91c1c;
        padding: 12px 16px;
        border-radius: 4px;
        margin-bottom: 16px;
        font-size: 14px;
    }
    
    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .content-wrapper {
            width: 95%;
        }
        
        .brand-message h2 {
            font-size: 40px;
        }
        
        .brand-message p {
            font-size: 18px;
        }
        
        .home-button {
            left: 40px;
        }
    }
    
    @media (max-width: 992px) {
        .content-wrapper {
            flex-direction: column;
            width: 90%;
            padding: 20px 0;
            margin-top: 40px;
        }
        
        .left-section, .right-section {
            width: 100%;
        }
        
        .left-section {
            margin-bottom: 30px;
            align-items: center;
            text-align: center;
            padding: 0;
        }
        
        .brand-logo {
            align-items: center;
        }
        
        .brand-message h2 {
            font-size: 36px;
        }
        
        .brand-message p {
            font-size: 18px;
        }
        
        .right-section {
            padding: 0;
        }
        
        .home-button {
            bottom: 20px;
            left: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .main-content {
            align-items: flex-start;
            padding-top: 60px;
            overflow-y: auto;
        }
        
        .content-wrapper {
            width: 95%;
            margin-top: 10px;
            min-height: auto;
        }
        
        .brand-message h2 {
            font-size: 32px;
        }
        
        .form-content {
            padding: 25px;
        }
    }
    
    @media (max-width: 576px) {
        .main-content {
            padding-top: 50px;
        }
        
        .content-wrapper {
            width: 100%;
            padding: 15px;
        }
        
        .logo-image {
            width: 150px;
            margin-top: -20px;
            margin-bottom: -10px;
        }
        
        .brand-message h2 {
            font-size: 28px;
        }
        
        .brand-message p {
            font-size: 16px;
        }
        
        .form-content {
            padding: 20px 15px;
        }
        
        .form-input {
            height: 40px;
            padding: 10px 12px;
        }
        
        .glass-form {
            width: 100%;
        }
        
        .home-button {
            left: 15px;
            bottom: 15px;
        }
    }
    
    @media (max-height: 700px) {
        .main-content {
            height: auto;
            min-height: 100vh;
            padding: 50px 0;
        }
        
        .content-wrapper {
            margin-top: 40px;
            margin-bottom: 60px;
        }
        
        .logo-image {
            width: 130px;
            margin-top: -10px;
            margin-bottom: 0;
        }
        
        .home-button {
            position: relative;
            left: auto;
            bottom: auto;
            margin-top: 30px;
            text-align: center;
            width: 100%;
            display: flex;
            justify-content: center;
        }
    }
</style>
@endsection 