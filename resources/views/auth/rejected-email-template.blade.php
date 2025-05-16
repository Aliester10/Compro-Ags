<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pendaftaran Ditolak</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #dc3545; color: white; padding: 15px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pendaftaran Distributor Ditolak</h2>
        </div>
        <div class="content">
            <p>Halo {{ $name }},</p>
            <p>Kami ingin memberitahukan bahwa pendaftaran distributor untuk <strong>{{ $companyName }}</strong> telah ditinjau dan tidak dapat disetujui saat ini.</p>
            <p>Beberapa alasan umum penolakan meliputi:</p>
            <ul>
                <li>Informasi pada dokumen tidak sesuai</li>
                <li>Dokumen tidak lengkap atau tidak jelas</li>
                <li>Area bisnis tidak sesuai dengan kriteria kami</li>
            </ul>
            
            <p>Jika Anda ingin informasi lebih lanjut atau ingin mengajukan kembali dengan informasi yang diperbarui, silakan hubungi kami di <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>.</p>
            
            <p>Kami menghargai minat Anda untuk menjadi distributor kami.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Nama Perusahaan Anda. All rights reserved.
        </div>
    </div>
</body>
</html>