@extends('layouts.app')

@section('title', 'Home - Travel App')

@section('content')
<!-- Hero Section -->
<section class="hero-gradient text-white py-5">
    <div class="container py-lg-5">
        <div class="row align-items-center py-lg-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 font-weight-bold mb-4 text-center text-lg-left">
                    🚌 Travel dengan Nyaman & Terjangkau
                </h1>
                <p class="lead mb-4 text-center text-lg-left">
                    Temukan pengalaman perjalanan terbaik dengan armada modern, 
                    sopir profesional, dan harga yang bersahabat. Pesan tiket 
                    travel Anda sekarang!
                </p>
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light mr-3 mb-2">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('penumpang.dashboard') }}" class="btn btn-light mr-3 mb-2">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Saya
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn btn-light mr-3 mb-2">
                            <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light mb-2">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <i class="fas fa-bus fa-10x text-light opacity-75"></i>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="h1 font-weight-bold text-dark mb-3">Mengapa Memilih Kami?</h2>
                <p class="lead text-muted">Layanan terbaik untuk perjalanan Anda</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title font-weight-bold text-center">Aman & Terpercaya</h4>
                        <p class="card-text text-muted text-center">
                            Armada terawat dengan sopir berpengalaman untuk perjalanan yang aman dan nyaman.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <i class="fas fa-clock fa-3x text-success"></i>
                        </div>
                        <h4 class="card-title font-weight-bold text-center">Tepat Waktu</h4>
                        <p class="card-text text-muted text-center">
                            Jadwal keberangkatan yang teratur dan tepat waktu sesuai dengan yang dijanjikan.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <i class="fas fa-money-bill-wave fa-3x text-warning"></i>
                        </div>
                        <h4 class="card-title font-weight-bold text-center">Harga Terjangkau</h4>
                        <p class="card-text text-muted text-center">
                            Tarif kompetitif dengan kualitas pelayanan terbaik untuk semua kalangan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Schedules Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="h1 font-weight-bold text-dark mb-3">Jadwal Travel Terpopuler</h2>
                <p class="lead text-muted">Pilihan rute favorit penumpang</p>
            </div>
        </div>
        
        @if($featuredSchedules->count() > 0)
            <div class="row justify-content-center">
                @foreach($featuredSchedules as $schedule)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white border-bottom-0 pb-0">
                            <h5 class="card-title font-weight-bold text-center mb-0">
                                <i class="fas fa-route text-primary mr-2"></i>
                                {{ $schedule->tujuan }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">
                                        <i class="fas fa-calendar mr-2"></i>Tanggal
                                    </span>
                                    <strong>{{ $schedule->tanggal_keberangkatan->format('d/m/Y') }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">
                                        <i class="fas fa-clock mr-2"></i>Waktu
                                    </span>
                                    <strong>{{ $schedule->waktu_keberangkatan }}</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">
                                        <i class="fas fa-users mr-2"></i>Kouta
                                    </span>
                                    <span class="badge 
                                        @if($schedule->kouta_tersedia == 0) badge-danger
                                        @elseif($schedule->kouta_tersedia < $schedule->kouta / 2) badge-warning
                                        @else badge-success @endif">
                                        {{ $schedule->kouta_tersedia }}/{{ $schedule->kouta }}
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">
                                        <i class="fas fa-tag mr-2"></i>Harga
                                    </span>
                                    <strong class="text-primary">Rp {{ number_format($schedule->harga, 0, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 text-center">
                            @auth
                                @if(auth()->user()->role === 'penumpang')
                                    <a href="{{ route('penumpang.schedules.index') }}" class="btn btn-primary btn-block">
                                        <i class="fas fa-ticket-alt mr-2"></i>Pesan Sekarang
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-block" disabled>
                                        <i class="fas fa-info-circle mr-2"></i>Login sebagai Penumpang
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('register') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-user-plus mr-2"></i>Daftar untuk Memesan
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if($featuredSchedules->count() >= 6)
            <div class="text-center mt-4">
                @auth
                    @if(auth()->user()->role === 'penumpang')
                        <a href="{{ route('penumpang.schedules.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list mr-2"></i>Lihat Semua Jadwal
                        </a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">
                        <i class="fas fa-eye mr-2"></i>Lihat Semua Jadwal
                    </a>
                @endauth
            </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                <h4 class="text-muted font-weight-normal">Belum ada jadwal travel tersedia</h4>
                <p class="text-muted">Silakan check kembali beberapa saat lagi</p>
            </div>
        @endif
    </div>
</section>

<!-- How It Works Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center mb-5">
                <h2 class="h1 font-weight-bold text-dark mb-3">Cara Memesan Tiket</h2>
                <p class="lead text-muted">4 langkah mudah untuk perjalanan Anda</p>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mx-auto mb-3" style="width: 40px; height: 40px; line-height: 40px; border-radius: 50%; background: #007bff; color: white; font-weight: bold;">1</div>
                        <div class="mb-3">
                            <i class="fas fa-user-plus fa-2x text-primary"></i>
                        </div>
                        <h5 class="card-title font-weight-bold text-center">Daftar Akun</h5>
                        <p class="card-text text-muted text-center">
                            Buat akun penumpang dengan mudah dan gratis
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mx-auto mb-3" style="width: 40px; height: 40px; line-height: 40px; border-radius: 50%; background: #007bff; color: white; font-weight: bold;">2</div>
                        <div class="mb-3">
                            <i class="fas fa-search fa-2x text-success"></i>
                        </div>
                        <h5 class="card-title font-weight-bold text-center">Cari Jadwal</h5>
                        <p class="card-text text-muted text-center">
                            Temukan jadwal travel yang sesuai dengan kebutuhan
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mx-auto mb-3" style="width: 40px; height: 40px; line-height: 40px; border-radius: 50%; background: #007bff; color: white; font-weight: bold;">3</div>
                        <div class="mb-3">
                            <i class="fas fa-ticket-alt fa-2x text-warning"></i>
                        </div>
                        <h5 class="card-title font-weight-bold text-center">Pesan Tiket</h5>
                        <p class="card-text text-muted text-center">
                            Lakukan pemesanan tiket dengan mudah dan cepat
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="mx-auto mb-3" style="width: 40px; height: 40px; line-height: 40px; border-radius: 50%; background: #007bff; color: white; font-weight: bold;">4</div>
                        <div class="mb-3">
                            <i class="fas fa-bus fa-2x text-info"></i>
                        </div>
                        <h5 class="card-title font-weight-bold text-center">Nikmati Perjalanan</h5>
                        <p class="card-text text-muted text-center">
                            Lakukan perjalanan dengan nyaman dan aman
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="hero-gradient text-white py-5">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center text-lg-left">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <h3 class="h2 font-weight-bold mb-2">Siap Memulai Perjalanan Anda?</h3>
                <p class="lead mb-0">
                    Daftar sekarang dan nikmati kemudahan memesan tiket travel online
                </p>
            </div>
            <div class="col-lg-4 text-center text-lg-right">
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-end">
                    @auth
                        @if(auth()->user()->role === 'penumpang')
                            <a href="{{ route('penumpang.schedules.index') }}" class="btn btn-light mr-3 mb-2">
                                <i class="fas fa-ticket-alt mr-2"></i>Pesan Tiket
                            </a>
                        @else
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-light mr-3 mb-2">
                                <i class="fas fa-tachometer-alt mr-2"></i>Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('register') }}" class="btn btn-light mr-3 mb-2">
                            <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light mb-2">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>
@endsection