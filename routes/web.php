<?php

use App\Http\Controllers\Admin\TravelScheduleController as AdminTravelScheduleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Penumpang\TravelScheduleController as PenumpangTravelScheduleController;
use App\Http\Controllers\Penumpang\BookingController as PenumpangBookingController;
use App\Http\Controllers\Penumpang\PaymentController as PenumpangPaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Auth;

// Auth Routes
Auth::routes();

// Public Routes
Route::get('/', [GuestController::class, 'index'])->name('guest');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    // CRUD Jadwal Travel
    Route::get('/schedules', [AdminTravelScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [AdminTravelScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [AdminTravelScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedule}/edit', [AdminTravelScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{schedule}', [AdminTravelScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [AdminTravelScheduleController::class, 'destroy'])->name('schedules.destroy');
    
    // Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    // Tambahkan di dalam group admin
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Penumpang Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('penumpang.dashboard');
    })->name('penumpang.dashboard');
    
    Route::get('/travel-schedules', [PenumpangTravelScheduleController::class, 'index'])->name('penumpang.schedules.index');
    Route::get('/bookings', [PenumpangBookingController::class, 'index'])->name('penumpang.bookings.index');
    Route::post('/bookings', [PenumpangBookingController::class, 'store'])->name('penumpang.bookings.store');
    Route::get('/bookings/{booking}', [PenumpangBookingController::class, 'show'])->name('penumpang.bookings.show');
    
    // Pembayaran
    Route::post('/payments', [PenumpangPaymentController::class, 'store'])->name('penumpang.payments.store');
    Route::get('/payments/invoice/{booking}', [PenumpangPaymentController::class, 'invoice'])->name('penumpang.payments.invoice');
});