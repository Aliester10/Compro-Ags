@extends('layouts.Member.master')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg p-4 rounded-3">
            <div class="card-body">
                <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Detail Proforma
                    Invoice</h2>

                <!-- Informasi Proforma Invoice -->
                <table class="table">
                    <tr>
                        <th>PI Number</th>
                        <td>{{ $proformaInvoice->pi_number }}</td>
                    </tr>
                    <tr>
                        <th>PI Date</th>
                        <td>{{ \Carbon\Carbon::parse($proformaInvoice->pi_date)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>PO Number</th>
                        <td>{{ $proformaInvoice->purchaseOrder->po_number }}</td>
                    </tr>
                    <tr>
                        <th>Subtotal</th>
                        <td>Rp{{ number_format($proformaInvoice->subtotal, 2) }}</td>
                    </tr>
                    @if (!empty($proformaInvoice->purchaseOrder->quotation->discount) && $proformaInvoice->purchaseOrder->quotation->discount > 0)
                    <tr>
                        <th>Discount</th>
                        <td>Rp{{ number_format($proformaInvoice->purchaseOrder->quotation->discount, 2) }}</td>
                    </tr>
                @endif
                    <tr>
                        <th>PPN</th>
                        <td>Rp{{ number_format($proformaInvoice->ppn, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Grand Total</th>
                        <td>Rp{{ number_format($proformaInvoice->grand_total_include_ppn, 2) }}</td>
                    </tr>
                    <tr>
                        <th>DP</th>
                        <td>Rp{{ number_format($proformaInvoice->dp, 2) }} ({{ $proformaInvoice->dp_percent }}%)</td>
                    </tr>
                    <tr>
                        <th>Installments</th>
                        <td>{{ $proformaInvoice->installments }} kali pembayaran</td>
                    </tr>
                    <tr>
                        <th>Next Payment Amount</th>
                        <td>
                            @if (!empty($proformaInvoice->next_payment_amount) && !empty($proformaInvoice->purchaseOrder->quotation->subtotal_price))
                                {{ number_format($proformaInvoice->next_payment_amount, 2) }} IDR
                                ({{ number_format(($proformaInvoice->next_payment_amount / $proformaInvoice->purchaseOrder->quotation->subtotal_price) * 100, 2) }}%)
                            @else
                                <span class="text-muted">Belum ada pembayaran berikutnya</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Payments Completed</th>
                        <td>{{ $proformaInvoice->payments_completed }} dari {{ $proformaInvoice->installments }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span
                                class="badge 
                            @if ($proformaInvoice->status === 'unpaid') bg-danger
                            @elseif ($proformaInvoice->status === 'partially_paid') bg-warning
                            @elseif ($proformaInvoice->status === 'paid') bg-success @endif">
                                {{ ucfirst($proformaInvoice->status) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Remarks</th>
                        <td>
                            @if (!empty($proformaInvoice->remarks))
                                {{ $proformaInvoice->remarks }}
                            @else
                                <span class="text-muted">Belum ada catatan dari admin.</span>
                            @endif
                        </td>
                    </tr>

                </table>

                <!-- Aksi -->
                <div class="mt-4">
                    <h4>Aksi</h4>
                    <div class="d-flex flex-column gap-2">
                        <!-- View & Download PDF -->
                        <a href="{{ asset($proformaInvoice->file_path) }}" target="_blank"
                            class="btn btn-info btn-sm rounded-pill">
                            <i class="fas fa-file-pdf"></i> View PDF
                        </a>
                        <a href="{{ asset($proformaInvoice->file_path) }}" download
                            class="btn btn-secondary btn-sm rounded-pill">
                            <i class="fas fa-download"></i> Download PDF
                        </a>

                        <!-- Upload Payment Proof -->
                        @if ($proformaInvoice->status !== 'paid' && $proformaInvoice->payments_completed < $proformaInvoice->installments)
                            @if ($proformaInvoice->payments_completed === 0 || $proformaInvoice->last_payment_status === 'approved')
                                <form action="{{ route('distributor.proforma-invoices.upload', $proformaInvoice->id) }}"
                                    method="POST" enctype="multipart/form-data" class="mt-2">
                                    @csrf
                                    <input type="file" name="payment_proof" class="form-control mb-2"
                                        accept=".pdf,.jpg,.jpeg,.png" required>
                                    <button type="submit" class="btn btn-success btn-sm rounded-pill">
                                        <i class="fas fa-upload"></i> Upload Pembayaran
                                        ke-{{ $proformaInvoice->payments_completed + 1 }}
                                    </button>
                                    <small class="text-muted">
                                        {{ $proformaInvoice->payments_completed + 1 === 1 ? 'DP' : 'Pembayaran Tahap ' . ($proformaInvoice->payments_completed + 1) }}
                                    </small>
                                </form>
                            @else
                                <span class="text-muted">Menunggu persetujuan admin untuk pembayaran sebelumnya.</span>
                            @endif
                        @else
                            <span class="text-muted">All payments completed or awaiting admin approval.</span>
                        @endif


                        @if (!empty($proformaInvoice->payment_proof_paths))
                        @foreach ($proformaInvoice->payment_proof_paths as $index => $filePath)
                            <div class="mt-2">
                                <a href="{{ asset($filePath) }}" target="_blank" class="btn btn-success btn-sm rounded-pill">
                                    <i class="fas fa-receipt"></i> View Payment Proof {{ $index + 1 }}
                                </a>
                                <a href="{{ asset($filePath) }}" download class="btn btn-secondary btn-sm rounded-pill">
                                    <i class="fas fa-download"></i> Download Payment Proof {{ $index + 1 }}
                                </a>
                            </div>
                        @endforeach
                    @else
                        <span class="text-muted">Belum ada bukti pembayaran yang diunggah.</span>
                    @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
