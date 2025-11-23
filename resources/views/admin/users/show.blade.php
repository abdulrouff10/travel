@extends('layouts.app')

@section('title', 'Detail Penumpang')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Informasi Penumpang -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user mr-2"></i>Informasi Penumpang
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="fas fa-user fa-2x text-white"></i>
                            </div>
                            <h4 class="mt-2 mb-1">{{ $user->name }}</h4>
                            <span class="badge badge-info">{{ $user->role === 'admin' ? 'Admin' : 'Penumpang' }}</span>
                        </div>
                    </div>
                    
                    <table class="table table-borderless">
                        <tr>
                            <th width="35%" class="text-muted">Email</th>
                            <td>
                                <i class="fas fa-envelope text-primary mr-2"></i>
                                {{ $user->email }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Tanggal Daftar</th>
                            <td>
                                <i class="fas fa-calendar text-primary mr-2"></i>
                                {{ $user->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">Member sejak</th>
                            <td>
                                <i class="fas fa-clock text-primary mr-2"></i>
                                {{ $user->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Statistik Penumpang -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar mr-2"></i>Statistik Pesanan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border rounded-lg p-3 bg-light">
                                <i class="fas fa-ticket-alt fa-2x text-primary mb-2"></i>
                                <h3 class="mb-1">{{ $user->bookings->count() }}</h3>
                                <small class="text-muted">Total Pesanan</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded-lg p-3 bg-light">
                                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                <h3 class="mb-1">{{ $user->bookings->where('status_pembayaran', 'paid')->count() }}</h3>
                                <small class="text-muted">Pesanan Lunas</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded-lg p-3 bg-light">
                                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                <h3 class="mb-1">{{ $user->bookings->where('status_pembayaran', '!=', 'paid')->count() }}</h3>
                                <small class="text-muted">Pesanan Pending</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded-lg p-3 bg-light">
                                <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                                <h3 class="mb-1">Rp {{ number_format($user->bookings->where('status_pembayaran', 'paid')->sum('total_harga'), 0, ',', '.') }}</h3>
                                <small class="text-muted">Total Pengeluaran</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Pesanan -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list-alt mr-2"></i>Riwayat Pesanan
                    </h5>
                </div>
                <div class="card-body">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Tanggal Pesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <i class="fas fa-route text-primary mr-2"></i>
                                            {{ $booking->travelSchedule->tujuan }}
                                        </td>
                                        <td>{{ $booking->travelSchedule->tanggal_keberangkatan->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge badge-secondary">{{ $booking->jumlah_tiket }} tiket</span>
                                        </td>
                                        <td class="font-weight-bold text-primary">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($booking->status_pembayaran == 'paid')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check mr-1"></i>Lunas
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock mr-1"></i>Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-muted">{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada riwayat Pesanan</h5>
                            <p class="text-muted">Penumpang ini belum melakukan Pesanan tiket.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        border-radius: 0.5rem;
    }
    
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
        font-weight: 600;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }
    
    .activity-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #e9ecef;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
</style>
@endsection