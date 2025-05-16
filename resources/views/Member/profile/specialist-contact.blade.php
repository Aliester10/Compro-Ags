<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Specialist Contact Message</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;600;700&display=swap');

        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --secondary: #4f46e5;
            --accent: #ec4899;
            --gray-light: #f8f9fa;
            --gray: #e9ecef;
            --dark: #212529;
            --gradient-1: linear-gradient(120deg, #6366f1, #4f46e5);
            --gradient-2: linear-gradient(120deg, #ec4899, #d946ef);
            --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 10px 30px rgba(0, 0, 0, 0.15);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        * {
            box-sizing: border-box;
            margin-top : -100px;
            padding: 0;
        }

        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.7;
            color: #495057;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            background-attachment: fixed;
            min-height: 100vh;
        }

        .container {
            max-width: 700px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .container:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .header {
            text-align: center;
            padding: 45px 30px 55px;
            background: var(--gradient-1);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: "";
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.08' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.6;
            z-index: 0;
        }

        .header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='white' fill-opacity='1' d='M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,133.3C672,139,768,181,864,202.7C960,224,1056,224,1152,202.7C1248,181,1344,139,1392,117.3L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            z-index: 1;
        }

        .badge {
            position: absolute;
            top: 20px;
            right: 20px;
            color: black;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: pulse 2s infinite;
        }

        h2 {
            margin: 0 0 15px;
            font-weight: 700;
            color: black;
            font-size: 32px;
            letter-spacing: 0.5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            font-family: 'Montserrat', sans-serif;
            position: relative;
            z-index: 2;
        }

        .header p {
            color: rgba(0, 0, 0, 0.9);
            font-size: 16px;
            margin: 0;
            position: relative;
            z-index: 2;
        }

        .content {
            padding: 40px;
        }

        .message-info,
        .message-content,
        .additional-info {
            animation: fadeIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            transition: all 0.4s ease-in-out;
            margin-bottom: 35px;
            border-radius: 16px;
            position: relative;
        }

        .message-info {
            background-color: #f8fafc;
            padding: 30px;
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            border-left: 5px solid var(--primary);
            overflow: hidden;
        }

        .message-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.15);
        }

        .message-info-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 22px;
            color: var(--primary);
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 15px;
            border-bottom: 2px dashed rgba(99, 102, 241, 0.2);
        }

        .message-info p {
            margin: 12px 0;
            display: flex;
            align-items: center;
        }

        .message-content {
            background-color: rgba(99, 102, 241, 0.05);
            padding: 35px 30px;
            border-radius: 16px;
            border-left: 5px solid var(--accent);
            position: relative;
            overflow: hidden;
        }

        .message-content:hover {
            box-shadow: 0 10px 25px rgba(236, 72, 153, 0.12);
            transform: translateY(-5px);
        }

        .message-content::before {
            content: '"';
            position: absolute;
            top: 5px;
            left: 20px;
            font-size: 80px;
            color: rgba(236, 72, 153, 0.08);
            font-family: Georgia, serif;
            line-height: 1;
        }

        .message-content::after {
            content: "";
            position: absolute;
            bottom: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.08) 0%, rgba(236, 72, 153, 0) 70%);
            border-radius: 50%;
        }

        .message-content h3 {
            margin-top: 0;
            color: var(--accent);
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-left: 20px;
            font-family: 'Montserrat', sans-serif;
            position: relative;
        }

        .message-content p {
            padding-left: 20px;
            position: relative;
            z-index: 1;
            font-size: 16px;
            line-height: 1.8;
        }

        .additional-info {
            background-color: #fff8f9;
            border-left: 5px solid #f59e0b;
            padding: 30px;
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        .additional-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.15);
        }

        .additional-info::after {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, rgba(245, 158, 11, 0) 70%);
            border-radius: 50%;
        }

        .additional-info p strong {
            color: #f59e0b;
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 15px;
            display: block;
            position: relative;
            padding-bottom: 10px;
            border-bottom: 2px dashed rgba(245, 158, 11, 0.2);
        }

        .footer {
            font-size: 14px;
            color: #94a3b8;
            text-align: center;
            padding: 30px;
            background-color: #f8fafc;
            border-top: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(90deg, var(--primary), var(--accent), #f59e0b);
            opacity: 0.7;
        }

        .footer:hover {
            background-color: #f1f5f9;
        }

        .footer p {
            margin: 8px 0;
        }

        .info-label {
            font-weight: 600;
            color: var(--primary);
            display: inline-block;
            width: 120px;
            position: relative;
            font-size: 14px;
            letter-spacing: 0.3px;
        }

        .info-label::before {
            content: "•";
            position: absolute;
            left: -15px;
            color: var(--primary-light);
        }

        .info-label::after {
            content: ":";
            position: absolute;
            right: 10px;
        }

        .info-value {
            font-weight: 400;
            flex: 1;
            padding-left: 12px;
            position: relative;
        }

        .info-value::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            height: 20px;
            width: 2px;
            background-color: #e2e8f0;
            transform: translateY(-50%);
        }

        .company-logo {
            margin-top: 20px;
            margin-bottom: 5px;
            text-align: center;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .social-link {
            display: inline-block;
            width: 36px;
            height: 36px;
            background-color: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            transform: translateY(-3px);
            background-color: var(--primary-light);
            color: white;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .message-info-icon, 
        .message-content-icon, 
        .additional-info-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
        }

        .message-info-icon {
            background: var(--gradient-1);
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
        }

        .message-content-icon {
            background: var(--gradient-2);
            box-shadow: 0 4px 10px rgba(236, 72, 153, 0.3);
        }

        .additional-info-icon {
            background: linear-gradient(120deg, #f59e0b, #fb923c);
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3);
        }

        /* Add responsive adjustments */
        @media (max-width: 768px) {
            .content {
                padding: 30px 20px;
            }
            
            .message-info, 
            .message-content, 
            .additional-info {
                padding: 25px 20px;
            }
            
            h2 {
                font-size: 26px;
            }
            
            .message-info-title {
                font-size: 20px;
            }
            
            .info-label {
                width: 100px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="badge">New Message</div>
            <h2>Pesan Baru dari Product Specialist</h2>
            <p>Notifikasi pesan masuk yang memerlukan respon Anda</p>
        </div>

        <div class="content">
            <div class="message-info">
                <div class="message-info-icon">👤</div>
                <h3 class="message-info-title">Informasi Pengirim</h3>
                <p>
                    <span class="info-label">Nama</span>
                    <span class="info-value">{{ $data['fullName'] }}</span>
                </p>
                <p>
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $data['email'] }}</span>
                </p>
                <p>
                    <span class="info-label">Telepon</span>
                    <span class="info-value">{{ $data['phone'] }}</span>
                </p>
                <p>
                    <span class="info-label">Perusahaan</span>
                    <span class="info-value">{{ $data['company'] ?? 'Tidak disebutkan' }}</span>
                </p>
            </div>

            <div class="message-content">
                <div class="message-content-icon">✉️</div>
                <h3>Pesan:</h3>
                <p>{{ $data['message'] }}</p>
            </div>

            <div class="additional-info">
                <div class="additional-info-icon">ℹ️</div>
                <p><strong>Informasi Tambahan</strong></p>
                <p>
                    <span class="info-label">Waktu</span>
                    <span class="info-value">{{ now()->format('d M Y, H:i:s') }}</span>
                </p>
                <p>
                    <span class="info-label">IP Address</span>
                    <span class="info-value">{{ request()->ip() }}</span>
                </p>
            </div>
        </div>

        <div class="footer">
            <div class="company-logo">
                <!-- You can add your company logo here -->
                <svg width="120" height="30" viewBox="0 0 120 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="30" height="30" rx="8" fill="#6366F1"/>
                    <path d="M7 15L13 21L23 9" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <p>&copy; {{ date('Y') }} PT.`Arkamaya Guna Saharsa. Handle With Love.</p>
            <p>Silahkan membalas pesan ke email berikut: {{ $data['email'] }}.</p>
            <p>Atau menghubungi nomor berikut: {{ $data['phone'] }}.</p>
            
            <div class="social-links">
                <a href="#" class="social-link">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>
</html>