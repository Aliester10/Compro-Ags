<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        @page {
            margin: 120px 50px 80px;
            /* Top, Right, Bottom, Left */
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
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
            color: #b89222;
        }

        .invoice-info p {
            margin: 2px 0;
            font-size: 12px;
        }

        .client-info {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .total-row {
            font-weight: bold;
            text-align: right;
        }

        .payment-info {
            margin-top: 20px;
            font-size: 12px;
            line-height: 1.5;
        }

        .signature {
            margin-top: 20px;
            font-size: 12px;
            text-align: left;
        }

        .signature img {
            height: 50px;
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
            <h1>INVOICE</h1>
            <p>Number: {{ $piNumberFormatted }}</p>
            <p>Date: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F d, Y') }}</p>
        </div>

        <!-- Client Information -->
        <div class="client-info">
            <p><strong>Billed To:</strong></p>
            <p><strong>{{ $vendor_name }}</strong></p>
            <p>{{ $vendor_address }}</p>
            <p>Phone: {{ $vendor_phone }}</p>
        </div>

        <!-- Invoice Description -->
        <p>Dear :{{ $vendor_name }}</p>
        <p>Based on Purchase Order {{ $poNumberFormatted }}, PT. Arkamaya Guna Saharsa submits the following invoice:
        </p>

        <!-- Product Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>QTY</th>
                    <th>Satuan</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->proformaInvoice->purchaseOrder->quotation->quotationProducts as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if ($loop->first)
                                @if ($invoice->type === 'dp')
                                    <!-- Keterangan DP -->
                                    <small><em>(Uang muka: 
                                        {{ number_format(($invoice->proformaInvoice->dp / $invoice->proformaInvoice->grand_total_include_ppn) * 100, 2) }}%)</em></small>
                                    <br>
                                @elseif ($invoice->type === 'next_payment')
                                    <!-- Keterangan Next Payment -->
                                    <small><em>(Pembayaran termin 
                                        {{ $invoice->proformaInvoice->payments_completed + 1 }} dari {{ $invoice->proformaInvoice->installments }} termin 
                                        - Persentase: {{ number_format(($invoice->percentage), 2) }}%)</em>
                                        @if ($invoice->proformaInvoice->payments_completed + 1 == $invoice->proformaInvoice->installments)
                                            <strong>- Pelunasan</strong>
                                        @endif
                                    </small>
                                    <br>
                                @endif
                            @endif
                        
                            <!-- Nama Produk -->
                            {{ $product->equipment_name }}
                        </td>
                        
                        
                        
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->merk_type }}</td>
                        <td>{{ number_format($product->unit_price, 2) }}</td>
                    </tr>
                @endforeach

                <!-- Row untuk Subtotal, PPN, dan Grand Total -->
                <tr class="total-row">
                    <td colspan="4">Sub Total</td>
                    <td>{{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4">PPN</td>
                    <td>{{ number_format($invoice->ppn, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="4"><strong>Grand Total Include PPN</strong></td>
                    <td><strong>{{ number_format($invoice->grand_total_include_ppn, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Payment Information -->
        <div class="payment-info">
            <p><strong>Please make payments to:</strong></p>
            <p>PT. Arkamaya Guna Saharsa</p>
            <p>Account No: 121-00-0022881-1</p>
            <p>Bank Mandiri Kebon Sirih</p>
            <p>Jl. Tanah Abang Timur No. I, RT.2/RW.3,</p>
            <p>Gambir, Central Jakarta City, Jakarta 10110</p>
        </div>

        <!-- Signature Section -->
        <div class="signature">
            <p>Kind Regards,</p>
            <p><strong>PT. Arkamaya Guna Saharsa</strong></p>
            <br>
            <img src="{{ public_path('pdfquo/signature.png') }}" alt="Signature">
            <p><strong>Agustina Panjaitan</strong></p>
            <p>Director</p>
        </div>
    </div>
</body>

</html>
