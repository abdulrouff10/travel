@extends('layouts.app')

@section('title', 'Dashboard Penumpang')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        
        
    </div>

    <!-- Info Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="info-box">
                <span class="info-box-icon bg-primary">
                    <i class="fas fa-ticket-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Pesanan Aktif</span>
                    <span class="info-box-number">
                        {{ \App\Models\Booking::where('user_id', auth()->id())->count() }}
                    </span>
                    <a href="{{ route('penumpang.bookings.index') }}" class="text-decoration-none small">
                        Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="info-box">
                <span class="info-box-icon bg-success">
                    <i class="fas fa-bus"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Jadwal Tersedia</span>
                    <span class="info-box-number">
                        {{ \App\Models\TravelSchedule::where('tanggal_keberangkatan', '>=', now()->toDateString())->count() }}
                    </span>
                    <a href="{{ route('penumpang.schedules.index') }}" class="text-decoration-none small">
                        Cari Jadwal <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="info-box">
                <span class="info-box-icon bg-info">
                    <i class="fas fa-dollar-sign"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pengeluaran</span>
                    <span class="info-box-number">
                        Rp {{ number_format(\App\Models\Booking::where('user_id', auth()->id())->where('status_pembayaran', 'paid')->sum('total_harga'), 0, ',', '.') }}
                    </span>
                    <span class="text-muted small">Seluruh pesanan</span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="info-box">
                <span class="info-box-icon bg-warning">
                    <i class="fas fa-clock"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Menunggu Pembayaran</span>
                    <span class="info-box-number">
                        {{ \App\Models\Booking::where('user_id', auth()->id())->where('status_pembayaran', 'pending')->count() }}
                    </span>
                    <a href="{{ route('penumpang.bookings.index') }}" class="text-decoration-none small">
                        Bayar Sekarang <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesanan Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-history mr-2"></i>Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    @php
                        $recentBookings = \App\Models\Booking::where('user_id', auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @if($recentBookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tujuan</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentBookings as $booking)
                                    <tr>
                                        <td>
                                            <strong>{{ $booking->travelSchedule->tujuan }}</strong>
                                        </td>
                                        <td>{{ $booking->travelSchedule->tanggal_keberangkatan->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->travelSchedule->waktu_keberangkatan)->format('H:i') }}</td>
                                        <td>
                                            <span class="badge badge-pill badge-secondary">
                                                {{ $booking->jumlah_tiket }} Tiket
                                            </span>
                                        </td>
                                        <td class="font-weight-bold">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($booking->status_pembayaran == 'paid')
                                                <span class="badge badge-success">Lunas</span>
                                            @elseif($booking->status_pembayaran == 'pending')
                                                <span class="badge badge-warning">Menunggu Pembayaran</span>
                                            @else
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        
                                    </tr>
                                    
                                    <!-- Modal Pembayaran -->
                                    @if($booking->status_pembayaran == 'pending')
                                    <div class="modal fade" id="paymentModal{{ $booking->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('penumpang.payments.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                        <div class="form-group">
                                                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                                            <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                                                                <option value="transfer">Transfer Bank</option>
                                                                <option value="cash">Tunai</option>
                                                                <option value="qris">QRIS</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                                                            <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
                                                            <small class="form-text text-muted">Upload bukti transfer atau pembayaran</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('penumpang.bookings.index') }}" class="btn btn-outline-primary">
                                Lihat Semua Pesanan <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-ticket-alt fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada Pesanan</h5>
                            <p class="text-muted mb-4">Mulai pesan tiket travel pertama Anda</p>
                            <a href="{{ route('penumpang.schedules.index') }}" class="btn btn-primary">
                                <i class="fas fa-search mr-1"></i> Cari Jadwal Travel
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection