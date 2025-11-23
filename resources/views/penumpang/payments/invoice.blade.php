@extends('layouts.app')

@section('title', 'Invoice Pesanan Tiket')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-file-invoice mr-2"></i>Invoice Pesanan #{{ $booking->id }}
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Informasi Pemesan dan Travel -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-user mr-2"></i>Informasi Pemesan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Nama</strong></td>
                                            <td>{{ $booking->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td>{{ $booking->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal Pesan</strong></td>
                                            <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-bus mr-2"></i>Informasi Travel
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td width="40%"><strong>Tujuan</strong></td>
                                            <td>{{ $booking->travelSchedule->tujuan }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal</strong></td>
                                            <td>{{ $booking->travelSchedule->tanggal_keberangkatan->format('d/m/Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Jam</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($booking->travelSchedule->waktu_keberangkatan)->format('H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pemesanan -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-receipt mr-2"></i>Detail Pemesanan
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Deskripsi</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-right">Harga Satuan</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>Tiket {{ $booking->travelSchedule->tujuan }}</strong>
                                            </td>
                                            <td class="text-center">
                                                {{ $booking->jumlah_tiket }} tiket
                                            </td>
                                            <td class="text-right">
                                                Rp {{ number_format($booking->travelSchedule->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="text-right font-weight-bold">
                                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        <tr class="table-success">
                                            <td colspan="3" class="text-right font-weight-bold">
                                                TOTAL
                                            </td>
                                            <td class="text-right font-weight-bold">
                                                Rp {{ number_format($booking->total_harga, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Status dan Action dalam satu baris -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <strong class="mr-2">Status:</strong>
                                        @if($booking->status_pembayaran == 'paid')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle mr-1"></i>LUNAS
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock mr-1"></i>MENUNGGU PEMBAYARAN
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-md-end gap-2">
                                        <a href="{{ route('penumpang.bookings.index') }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-arrow-left mr-1"></i>Kembali
                                        </a>
                                        <button onclick="window.print()" class="btn btn-primary btn-sm">
                                            <i class="fas fa-print mr-1"></i>Cetak
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Penting -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h6 class="mb-2">
                                <i class="fas fa-exclamation-circle mr-2"></i>Informasi Penting
                            </h6>
                            <ul class="mb-0 pl-3 small">
                                <li>Simpan invoice ini sebagai bukti pembayaran</li>
                                <li>Tunjukkan invoice saat boarding</li>
                                <li>Hubungi customer service untuk bantuan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .navbar, .sidebar, .btn, .main-footer, .content-header {
        display: none !important;
    }
    .card {
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
    .bg-primary {
        background: #f8f9fa !important;
        color: #000 !important;
    }
}
</style>
@endsection