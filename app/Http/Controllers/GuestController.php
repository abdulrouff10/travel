<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelSchedule;

class GuestController extends Controller
{
    public function index()
    {
        // Ambil jadwal travel terbaru untuk ditampilkan di landing page
        $featuredSchedules = TravelSchedule::where('tanggal_keberangkatan', '>=', now()->toDateString())
            ->orderBy('tanggal_keberangkatan', 'asc')
            ->take(6)
            ->get();

        return view('guest', compact('featuredSchedules'));
    }
}