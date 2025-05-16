<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pendaftaran Disetujui</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #28a745; color: white; padding: 15px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
        .btn { display: inline-block; padding: 10px 20px; background: #0d6efd; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pendaftaran Distributor Disetujui</h2>
        </div>
        <div class="content">
            <p>Halo {{ $name }},</p>
            <p>Kami dengan senang hati memberitahukan bahwa pendaftaran distributor untuk <strong>{{ $companyName }}</strong> telah disetujui.</p>
            <p>Anda sekarang dapat masuk ke akun Anda dan mulai menggunakan layanan kami.</p>
            
            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ $loginUrl }}" class="btn">Login Sekarang</a>
            </p>
            
            <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi tim dukungan kami.</p>
            
            <p>Terima kasih telah bergabung dengan kami!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Nama Perusahaan Anda. All rights reserved.
        </div>
    </div>
</body>
</html>