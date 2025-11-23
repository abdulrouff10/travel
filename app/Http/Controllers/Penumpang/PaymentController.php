<?php

namespace App\Http\Controllers\Penumpang;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'metode_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        // Pastikan booking milik user yang login
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        // Upload bukti pembayaran
        $buktiPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Buat payment record
        Payment::create([
            'booking_id' => $booking->id,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $booking->total_harga,
            'waktu_pembayaran' => now(),
            'bukti_pembayaran' => $buktiPath
        ]);

        // Update status booking menjadi paid
        $booking->update(['status_pembayaran' => 'paid']);

        return redirect()->route('penumpang.payments.invoice', $booking)
            ->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }

    public function invoice(Booking $booking)
    {
        // Pastikan booking milik user yang login
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('penumpang.payments.invoice', compact('booking'));
    }
}