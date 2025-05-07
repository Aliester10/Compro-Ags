<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proforma Invoice #{{ $proformaInvoice->pi_number }}</title>
    <style>
        @page {
            margin: 120px 50px 80px; /* Top, Right, Bottom, Left */
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Header */
        .header {
            position: fixed;
            top: -120px;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
        }
        .header img {
            width: 100%;
            height: auto;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: -100px;
            left: 0;
            right: 0;
            height: 100px;
            text-align: center;
        }
        .footer img {
            width: 100%;
            height: auto;
        }

        /* Content */
        .content {
            margin-top: 20px;
        }

        .invoice-info {
            text-align: right;
            margin-bottom: 20px;
        }
        .invoice-info h1 {
            font-size: 24px;
            margin: 0;
        }
        .invoice-info p {
            margin: 2px 0;
            font-size: 12px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 10px;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 12px;
        }
        .table th {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .right-align {
            text-align: right;
            padding-right: 10px;
            font-weight: bold;
        }

        .signature {
            margin-top: 20px;
            font-size: 12px;
            text-align: left;
        }
        .signature img {
            height: 40px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('pdfquo/header.png') }}" alt="Header Image">
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="{{ public_path('pdfquo/footer.png') }}" alt="Footer Image">
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Invoice Information -->
        <div class="invoice-info">
            <h1>PROFORMA INVOICE</h1>
            <p>Number: {{ $piNumberFormatted }}</p>
            <p>Date: {{ \Carbon\Carbon::parse($proformaInvoice->pi_date)->format('F d, Y') }}</p>
        </div>

        <!-- Vendor Information -->
        <p class="section-title">Billed To:</p>
        <p><strong>{{ $vendorName }}</strong></p>
        <p>{{ $vendorAddress }}</p>
        <p>Phone: {{ $vendorPhone }}</p>

        <p>Dear :{{ $vendorName }}</p>
        <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Arkamaya Guna Saharsa submits the following proforma invoice:</p>

        <!-- Product Table -->
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th style="width: 40%;">Description</th>
                    <th style="width: 10%;">QTY</th>
                    <th style="width: 20%;">Satuan</th>
                    <th style="width: 25%;">Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product['description'] }}</td>
                        <td>{{ $product['qty'] }}</td>
                        <td>{{ $product['unit'] }}</td>
                        <td>{{ number_format($product['unit_price'], 2) }}</td>
                    </tr>
                @endforeach
                <!-- Summary Rows -->
                <tr>
                    <td colspan="4" class="right-align">Sub Total</td>
                    <td>{{ number_format($proformaInvoice->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align">PPN</td>
                    <td>{{ number_format($proformaInvoice->ppn, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align">Grand Total Include PPN</td>
                    <td>{{ number_format($proformaInvoice->grand_total_include_ppn, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="right-align"><strong>Down Payment (DP)</strong></td>
                    <td>{{ number_format($dpPercent, 2) }}% - Rp {{ number_format($proformaInvoice->dp, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Terms -->
        <p class="section-title">Term Payment:</p>
        <p>Please make payments to:</p>
        <p>PT. Arkamaya Guna Saharsa</p>
        <p>Account No: 121-00-0022881-1</p>
        <p>Bank Mandiri Kebon Sirih</p>
        <p>Jl. Tanah Abang Timur No. 1, RT.2/RW.3, Gambir, Central Jakarta City, Jakarta 10110</p>

        <!-- Signature Section -->
        <div class="signature">
            <p>Should you require further information please do not hesitate to contact the undersigned.</p>
            <p>Kind Regards,</p>
            <p><strong>PT. Arkamaya Guna Saharsa</strong></p>
            <br>
            <img src="{{ public_path('pdfquo/signature.png') }}" alt="Signature">
            <p><strong>Agustina Panjaitan</strong><br>Director</p>
        </div>
    </div>
</body>
</html>
