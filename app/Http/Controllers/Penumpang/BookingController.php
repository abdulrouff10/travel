<?php

namespace App\Http\Controllers\Penumpang;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // TAMBAHKAN METHOD INDEX
    public function index()
    {
        $bookings = Booking::with('travelSchedule')
                          ->where('user_id', auth()->id())
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('penumpang.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'travel_schedule_id' => 'required|exists:travel_schedules,id',
            'jumlah_tiket' => 'required|integer|min:1'
        ]);

        $schedule = TravelSchedule::findOrFail($request->travel_schedule_id);

        // Validasi kouta - SESUAI SOAL
        if ($schedule->kouta_tersedia < $request->jumlah_tiket) {
            return back()->with('error', 'Kouta tidak mencukupi. Kouta tersedia: ' . $schedule->kouta_tersedia);
        }

        // Buat booking - SESUAI SOAL
        Booking::create([
            'user_id' => auth()->id(),
            'travel_schedule_id' => $request->travel_schedule_id,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $schedule->harga * $request->jumlah_tiket,
            'status_pembayaran' => 'pending'
        ]);

        return redirect()->route('penumpang.bookings.index')
            ->with('success', 'Pesanan berhasil! Silakan lakukan pembayaran.');
    }

    // TAMBAHKAN METHOD SHOW
    public function show(Booking $booking)
    {
        // Pastikan booking milik user yang login
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('penumpang.bookings.show', compact('booking'));
    }
}