@extends('layouts.app')

@section('title', 'Riwayat Pemesanan Tiket')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        
    </div>

    @if($bookings->count() > 0)
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Tujuan Travel</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Harga</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
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
                                    @else
                                        <span class="badge badge-warning">Menunggu Pembayaran</span>
                                    @endif
                                </td>
                                <td>
                                    @if($booking->status_pembayaran == 'pending')
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#paymentModal{{ $booking->id }}">
                                            Bayar
                                        </button>
                                    @else
                                        <a href="{{ route('penumpang.payments.invoice', $booking) }}" class="btn btn-sm btn-info">
                                            Invoice
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-ticket-alt fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada riwayat pemesanan</h5>
                <a href="{{ route('penumpang.schedules.index') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-search mr-1"></i> Cari Jadwal Travel
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Modal Pembayaran -->
@foreach($bookings as $booking)
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
@endsection