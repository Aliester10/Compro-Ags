@extends('layouts.Member.master2')

@section('content')
<!-- Add font styling for the entire page -->
<style>
    body, h1, h2, h3, h4, h5, h6, p, label, input, button, .form-control, .alert, .text-danger, .card, .card-header, .card-body, small {
        font-family: 'Work Sans', sans-serif !important;
    }
    
    /* Password visibility toggle */
    .password-container {
        position: relative;
    }
    
    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
    }
    
    /* Success popup styling */
    .success-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
        z-index: 1000;
        text-align: center;
        display: none;
        max-width: 400px;
        width: 90%;
    }
    
    .success-popup .icon {
        font-size: 50px;
        color: #28a745;
        margin-bottom: 20px;
    }
    
    .popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0,0.5);
        z-index: 999;
        display: none;
    }
</style>

<!-- Header -->
<div class="header">
    <h1>PT. Arkamaya Guna Saharsa</h1>
</div>

<style>
    /* Header Styling */
    .header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 7.5px 0;
        background: linear-gradient(to right, #6E6E6E, #FFFFFF);
        z-index: 10;
        text-align: center;
        height: 33px;
    }
    
    .header h1 {
        font-size: 12px;
        font-weight: 500;
        color: #000000;
        margin: 0;
    }
</style>

<!-- Success Popup -->
<div class="popup-overlay" id="popupOverlay"></div>
<div class="success-popup" id="successPopup">
    <div class="icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <h4>Registration Successful!</h4>
    <p>Your account has been created successfully.</p>
    <button class="btn btn-primary w-100" onclick="closePopup()">OK</button>
</div>
    
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header bg-primary text-white text-center ">
                    <h4 class="mb-0 text-white ">USER REGISTRATION</h4>
                </div>
                <div class="card-body px-5">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="/enduser/register" id="registrationForm">
                        @csrf

                        <!-- Institution Name Field -->
                        <div class="form-group mb-3">
                            <label for="institution_name" class="form-label">Institution Name</label>
                            <input type="text" id="institution_name" name="institution_name" class="form-control" value="{{ old('institution_name') }}" required>
                            @error('institution_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Major Field -->
                        <div class="form-group mb-3">
                            <label for="major" class="form-label">Major</label>
                            <select id="major" name="major" class="form-control" required>
                                <option value="" selected disabled>Select major</option>
                                <option value="Computer Science" {{ old('major') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                <option value="Information Technology" {{ old('major') == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                                <option value="Information Systems" {{ old('major') == 'Information Systems' ? 'selected' : '' }}>Information Systems</option>
                                <option value="Software Engineering" {{ old('major') == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                                <option value="Data Science" {{ old('major') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                <option value="Mechanical Engineering" {{ old('major') == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                                <option value="Electrical Engineering" {{ old('major') == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                                <option value="Civil Engineering" {{ old('major') == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                                <option value="Other" {{ old('major') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('major')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Mobile Number Institution Field -->
                        <div class="form-group mb-3">
                            <label for="mobile_number" class="form-label">Mobile Number Institution</label>
                            <input type="text" id="mobile_number" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" required>
                            @error('mobile_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="password-container">
                                <input type="password" id="password" name="password" class="form-control" required>
                                <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                                    <i id="password-icon" class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="password-container">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                <span class="password-toggle" onclick="togglePasswordVisibility('password_confirmation')">
                                    <i id="password_confirmation-icon" class="fas fa-eye"></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Terms and Privacy Policy Checkbox -->
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                <label class="form-check-label" for="terms">
                                    By continuing, I agree to Privacy Policy and Terms of Use.
                                </label>
                                @error('terms')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary text-white w-100 mt-4">REGISTER NOW</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Password visibility toggle
    function togglePasswordVisibility(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const passwordIcon = document.getElementById(fieldId + '-icon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        }
    }
    
    // Success popup handling
    function showSuccessPopup() {
        document.getElementById('popupOverlay').style.display = 'block';
        document.getElementById('successPopup').style.display = 'block';
    }
    
    function closePopup() {
        document.getElementById('popupOverlay').style.display = 'none';
        document.getElementById('successPopup').style.display = 'none';
        window.location.href = "{{ route('enduser.register') }}";
    }
    
    // Show popup if there's a success message
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            showSuccessPopup();
        @endif
    });
</script>
@endsection