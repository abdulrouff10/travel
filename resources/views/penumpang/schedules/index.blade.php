@extends('layouts.app')

@section('title', 'Jadwal Travel Tersedia')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        
    </div>

    @if($schedules->count() > 0)
        <div class="row">
            @foreach($schedules as $schedule)
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-route mr-2 text-primary"></i>
                            {{ $schedule->tujuan }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon">
                                        <i class="fas fa-calendar-day text-primary"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Tanggal</span>
                                        <span class="info-box-number">{{ $schedule->tanggal_keberangkatan->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon">
                                        <i class="fas fa-clock text-success"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Waktu</span>
                                        <span class="info-box-number">{{ \Carbon\Carbon::parse($schedule->waktu_keberangkatan)->format('H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon">
                                        <i class="fas fa-users text-info"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Kouta</span>
                                        <span class="info-box-number">{{ $schedule->kouta_tersedia }}/{{ $schedule->kouta }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-box bg-light">
                                    <span class="info-box-icon">
                                        <i class="fas fa-tag text-warning"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Harga</span>
                                        <span class="info-box-number">Rp {{ number_format($schedule->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($schedule->kouta_tersedia > 0)
                            <form action="{{ route('penumpang.bookings.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="travel_schedule_id" value="{{ $schedule->id }}">
                                <div class="form-group mb-3">
                                    <label for="jumlah_tiket_{{ $schedule->id }}" class="form-label font-weight-bold">
                                        <i class="fas fa-ticket-alt mr-1"></i>Jumlah Tiket
                                    </label>
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <div class="input-group">
                                                <input type="number" 
                                                       class="form-control" 
                                                       id="jumlah_tiket_{{ $schedule->id }}" 
                                                       name="jumlah_tiket" 
                                                       min="1" 
                                                       max="{{ $schedule->kouta_tersedia }}" 
                                                       value="1" 
                                                       required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">tiket</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-success btn-block">
                                                <i class="fas fa-shopping-cart mr-2"></i>Pesan
                                            </button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted mt-2">
                                        Maksimal {{ $schedule->kouta_tersedia }} tiket tersedia
                                    </small>
                                </div>
                            </form>
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                                <p class="text-danger font-weight-bold mb-0">Kouta Habis</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-bus fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Tidak ada jadwal travel tersedia saat ini</h5>
                <p class="text-muted">Silakan coba lagi nanti</p>
            </div>
        </div>
    @endif
</div>
@endsection