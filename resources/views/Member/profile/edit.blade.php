@extends('layouts.Member.master-black')

@section('content')

<style>
    .custom-form-control {
        width: 100%;
        height: 73px;
        border-radius: 10px;
        padding: 0 15px;
        border: 1px solid #ddd;
        background-color: #f8f8f8;
    }
    
    .section-heading {
        font-size: clamp(20px, 5vw, 24px);
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
    }
    
    .required-field {
        font-size: 14px;
        color: #666;
        margin-bottom: 15px;
    }
    
    .nav-tabs-container {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
        border-bottom: 1px solid #dee2e6;
    }
    
    .nav-tabs {
        border-bottom: none;
        margin-bottom: 0;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .nav-tabs .nav-link {
        color: #666;
        border: none;
        padding: 12px 15px;
        font-size: clamp(14px, 3vw, 16px);
        text-align: center;
    }
    
    .nav-tabs .nav-link.active {
        color: #000;
        font-weight: 500;
        border-bottom: 2px solid #0d6efd;
    }
    
    .main-heading {
        text-align: center;
        font-size: clamp(24px, 6vw, 32px);
        font-weight: 900;
        margin-bottom: 20px;
    }
    
    .btn-action {
        background-color: #0d6efd;
        color: white;
        height: 50px;
        border-radius: 5px;
        font-weight: 600;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin: 20px 0;
        padding: 0 30px;
        border: none;
    }
    
    .phone-input-group {
        display: flex;
        flex-wrap: wrap;
    }
    
    .phone-prefix {
        width: 80px;
        height: 73px;
        border: 1px solid #ddd;
        border-radius: 10px 0 0 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f8f8;
    }
    
    .phone-input {
        flex: 1;
        border-radius: 0 10px 10px 0 !important;
    }
    
    .password-requirements {
        margin-top: 15px;
    }
    
    .requirement-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .requirement-icon {
        margin-right: 10px;
    }
    
    @media (max-width: 767.98px) {
        .container {
            margin-top: 8rem !important;
            padding: 0 15px;
        }
        
        .custom-form-control {
            height: 60px;
        }
        
        .phone-prefix {
            height: 60px;
        }
        
        .nav-tabs {
            overflow-x: auto;
            justify-content: flex-start;
            padding-bottom: 5px;
        }
        
        .nav-tabs-container {
            overflow-x: auto;
        }
        
        .main-heading {
            font-size: 32px;
        }
        
        .section-heading {
            font-size: 22px;
        }
    }
    
    @media (max-width: 575.98px) {
        .container {
            margin-top: 5rem !important;
        }
        
        .nav-tabs .nav-link {
            padding: 10px 8px;
            font-size: 14px;
        }
        
        .btn-action {
            height: 45px;
            width: 100%;
        }
    }
</style>

<div class="container" style="margin-top: 12rem; margin-bottom: 10rem;">
    <h1 class="main-heading">User Account</h1>
    
    <div class="nav-tabs-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Profile User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Talk to our Product Specialist</a>
            </li>
        </ul>
    </div>
    
    <div class="row">
        <!-- Left Column: General Information -->
        <div class="col-lg-6 col-md-12 mb-4">
            <h2 class="section-heading">General Information</h2>
            <p class="required-field">*Required field</p>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" id="name" class="custom-form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Gender *</label>
                    <select name="gender" id="gender" class="custom-form-control" required>
                        <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Phone Number</label>
                    <div class="phone-input-group">
                        <div class="phone-prefix">
                            +62
                        </div>
                        <input type="text" name="no_telp" id="no_telp" class="custom-form-control phone-input" value="{{ old('no_telp', $user->no_telp) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" id="email" class="custom-form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Date of Birth *</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="custom-form-control" value="{{ old('date_of_birth', $user->date_of_birth) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">FIRM/COMPANY</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="custom-form-control" value="{{ old('nama_perusahaan', $user->nama_perusahaan) }}">
                </div>

                <div class="mb-4">
                    <button type="submit" class="btn btn-action">SAVE</button>
                </div>
            </form>
        </div>

        <!-- Right Column: Change Password -->
        <div class="col-lg-6 col-md-12">
            <h2 class="section-heading">Change Password</h2>
            <p class="required-field">*Required field</p>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label">Current Password *</label>
                    <input type="password" name="current_password" id="current_password" class="custom-form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">New Password *</label>
                    <input type="password" name="new_password" id="new_password" class="custom-form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm Password *</label>
                    <input type="password" name="new_password_confirmation" id="confirm_password" class="custom-form-control" required>
                </div>

                <div class="mb-4">
                    <p class="form-label mb-2">Password must contain:</p>
                    <div class="password-requirements">
                        <div class="requirement-item">
                            <input type="radio" disabled checked class="requirement-icon">
                            <span>8 characters (letters)</span>
                        </div>
                        <div class="requirement-item">
                            <input type="radio" disabled checked class="requirement-icon">
                            <span>1 number</span>
                        </div>
                        <div class="requirement-item">
                            <input type="radio" disabled checked class="requirement-icon">
                            <span>1 lowercase letter</span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <button type="submit" class="btn btn-action">CHANGE PASSWORD</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection