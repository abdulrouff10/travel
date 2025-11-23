@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-8 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1">
                    <i class="fas fa-calendar-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Jadwal Travel</span>
                    <span class="info-box-number">
                        {{ \App\Models\TravelSchedule::count() }}
                    </span>
                    <a href="{{ route('admin.schedules.index') }}" class="small-box-footer">
                        Kelola Jadwal <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-8 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1">
                    <i class="fas fa-file-alt"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pesanan</span>
                    <span class="info-box-number">{{ \App\Models\Booking::count() }}</span>
                    <a href="{{ route('admin.reports') }}" class="small-box-footer">
                        Lihat Laporan <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-12 col-sm-8 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1">
                    <i class="fas fa-users"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">Penumpang Terdaftar</span>
                    <span class="info-box-number">
                        {{ \App\Models\User::where('role', 'penumpang')->count() }}
                    </span>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                        Lihat Data <i class="fas fa-arrow-circle-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Travel Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-bus mr-2"></i>Jadwal Travel Terbaru</h3>
                    <div class="card-tools">
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $recentSchedules = \App\Models\TravelSchedule::orderBy('created_at', 'desc')->take(5)->get();
                    @endphp
                    
                    @if($recentSchedules->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Tujuan</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Kouta</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentSchedules as $schedule)
                                    <tr>
                                        <td>
                                            <i class="fas fa-route mr-2 text-primary"></i>
                                            {{ $schedule->tujuan }}
                                        </td>
                                        <td>{{ $schedule->tanggal_keberangkatan->format('d/m/Y') }}</td>
                                        <td>
                                            @php
                                                // Format waktu hanya jam dan menit
                                                $waktu = \Carbon\Carbon::createFromFormat('H:i:s', $schedule->waktu_keberangkatan)->format('H:i');
                                            @endphp
                                            {{ $waktu }}
                                        </td>
                                        <td>
                                            @if($schedule->kouta_tersedia == 0)
                                                <span class="badge badge-danger">{{ $schedule->kouta_tersedia }}/{{ $schedule->kouta }}</span>
                                            @elseif($schedule->kouta_tersedia < $schedule->kouta / 2)
                                                <span class="badge badge-warning">{{ $schedule->kouta_tersedia }}/{{ $schedule->kouta }}</span>
                                            @else
                                                <span class="badge badge-success">{{ $schedule->kouta_tersedia }}/{{ $schedule->kouta }}</span>
                                            @endif
                                        </td>
                                        <td>Rp {{ number_format($schedule->harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($schedule->tanggal_keberangkatan->isFuture())
                                                <span class="badge badge-success">Akan Datang</span>
                                            @else
                                                <span class="badge badge-secondary">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada jadwal travel.</p>
                            <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i> Tambah Jadwal
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection