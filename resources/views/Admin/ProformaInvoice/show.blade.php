@extends('layouts.Admin.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4 rounded-3">
        <div class="card-body">
            <h2 class="text-center mb-4" style="font-family: 'Poppins', sans-serif; color: #00796b;">Detail Proforma Invoice</h2>

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
                    <th>Distributor</th>
                    <td>{{ $proformaInvoice->purchaseOrder->user->name }}</td>
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
                    <td>Rp{{ number_format($proformaInvoice->dp, 2) }}</td>
                </tr>
                <tr>
                    <th>Installments</th>
                    <td>{{ $proformaInvoice->installments ?? '-' }} kali pembayaran</td>
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
                    <td>{{ $proformaInvoice->payments_completed ?? 0 }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge 
                            @if ($proformaInvoice->status === 'paid') bg-success
                            @elseif ($proformaInvoice->status === 'partially_paid') bg-warning
                            @else bg-secondary
                            @endif">
                            {{ ucfirst($proformaInvoice->status) }}
                        </span>
                    </td>
                </tr>
            </table>
            <h4 class="mt-4">Aksi</h4>
            <div class="d-flex flex-column gap-2">
                <!-- View & Download PDF -->
                <a href="{{ asset($proformaInvoice->file_path) }}" target="_blank" class="btn btn-info btn-sm rounded-pill shadow-sm">
                    <i class="fas fa-file-pdf"></i> View PDF
                </a>
                <a href="{{ asset($proformaInvoice->file_path) }}" download class="btn btn-secondary btn-sm rounded-pill shadow-sm">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            
                <!-- Payment Proofs -->
                @if (!empty($proformaInvoice->payment_proof_paths))
                    <h5 class="mt-3">Bukti Pembayaran</h5>
                    @foreach ($proformaInvoice->payment_proof_paths as $index => $filePath)
                        <div class="mt-2">
                            <a href="{{ asset($filePath) }}" target="_blank" class="btn btn-success btn-sm rounded-pill shadow-sm">
                                <i class="fas fa-receipt"></i> View Payment Proof {{ $index + 1 }}
                            </a>
                            <a href="{{ asset($filePath) }}" download class="btn btn-secondary btn-sm rounded-pill shadow-sm">
                                <i class="fas fa-download"></i> Download Payment Proof {{ $index + 1 }}
                            </a>
            
                            <!-- Approve/Reject Form for Each Proof -->
                            @if ($proformaInvoice->last_payment_status === 'pending' && $index + 1 === $proformaInvoice->payments_completed + 1)
                                <form action="{{ route('admin.proforma-invoices.approve-reject', $proformaInvoice->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PUT')
            
                                    <div class="mb-3">
                                        <label for="remarks_{{ $index }}" class="form-label">Remarks</label>
                                        <textarea name="remarks" id="remarks_{{ $index }}" rows="2" class="form-control" required></textarea>
                                    </div>
            
                                      <!-- Input Persentase Pembayaran -->
                                      @if ($index + 1 < $proformaInvoice->installments)
                                      <!-- Input Persentase Pembayaran -->
                                      <div class="mb-3">
                                          <label for="next_payment_percentage_{{ $index }}" class="form-label">Next Payment Percentage</label>
                                          <input 
                                              type="number" 
                                              name="next_payment_percentage" 
                                              id="next_payment_percentage_{{ $index }}" 
                                              class="form-control" 
                                              placeholder="Enter percentage (e.g., 20)" 
                                              required>
                                          <small class="text-muted">Masukkan persentase pembayaran berikutnya dalam %</small>
                                      </div>
                                  @endif
                                    <div class="d-flex gap-2">
                                        <button type="submit" name="action" value="approve" class="btn btn-success btn-sm rounded-pill">
                                            <i class="fas fa-check-circle"></i> Approve Payment {{ $index + 1 }}
                                        </button>
                                        <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm rounded-pill">
                                            <i class="fas fa-times-circle"></i> Reject Payment {{ $index + 1 }}
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endforeach
                @else
                    <span class="text-muted">Belum ada bukti pembayaran yang diunggah.</span>
                @endif
                @if ($proformaInvoice->dp > 0 && !$proformaInvoice->dp_invoice_created)
                <!-- Tombol untuk Down Payment -->
                <a href="{{ route('invoices.create', ['proformaInvoiceId' => $proformaInvoice->id, 'type' => 'dp']) }}" 
                   class="btn btn-primary btn-sm rounded-pill shadow-sm mt-2">
                    <i class="fas fa-plus"></i> Create Invoice for Down Payment (DP)
                </a>
            @endif
            
            @if ($proformaInvoice->next_payment_amount > 0)
                <!-- Tombol untuk Next Payment -->
                <a href="{{ route('invoices.create', ['proformaInvoiceId' => $proformaInvoice->id, 'type' => 'next_payment']) }}" 
                   class="btn btn-primary btn-sm rounded-pill shadow-sm mt-2">
                    <i class="fas fa-plus"></i> Create Invoice for Next Payment
                </a>
            @endif
            
            
            




            </div>
            

        </div>
    </div>
</div>
@endsection
