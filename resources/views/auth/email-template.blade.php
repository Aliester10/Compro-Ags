<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pendaftaran Distributor Baru</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #0d6efd; color: white; padding: 15px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
        .btn { display: inline-block; padding: 10px 20px; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px; }
        .btn-success { background: #28a745; }
        .btn-danger { background: #dc3545; }
        .info-item { margin-bottom: 5px; }
        .buttons { text-align: center; margin: 30px 0 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pendaftaran Distributor Baru</h2>
        </div>
        <div class="content">
            <p>Halo Admin,</p>
            <p>Distributor baru telah mendaftar dengan detail berikut:</p>
            
            <div class="info-item"><strong>Nama:</strong> {{ $userName }}</div>
            <div class="info-item"><strong>Email:</strong> {{ $userEmail }}</div>
            <div class="info-item"><strong>Nama Perusahaan:</strong> {{ $companyName }}</div>
            <div class="info-item"><strong>PIC:</strong> {{ $pic }}</div>
            <div class="info-item"><strong>Nomor Telepon PIC:</strong> {{ $picPhone }}</div>
            <div class="info-item"><strong>Alamat:</strong> {{ $address }}</div>
            
            <p>Dokumen yang dilampirkan:</p>
            <div class="info-item"><strong>Akta:</strong> <a href="{{ $akta_path }}">Lihat Dokumen Akta</a></div>
            <div class="info-item"><strong>NIB:</strong> <a href="{{ $nib_path }}">Lihat Dokumen NIB</a></div>
            
            <p>{{ $body }}</p>
            
            <div class="buttons">
                <a href="{{ $verifyLink }}" class="btn btn-success">SETUJUI PENDAFTARAN</a>
                <a href="{{ $rejectLink }}" class="btn btn-danger">TOLAK PENDAFTARAN</a>
            </div>
            
            <p>Anda dapat langsung mengklik tombol di atas untuk memverifikasi atau menolak pendaftaran.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Nama Perusahaan Anda. All rights reserved.
        </div>
    </div>
</body>
</html>