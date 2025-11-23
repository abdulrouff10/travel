<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;

class TravelScheduleController extends Controller
{
    public function index()
    {
        $schedules = TravelSchedule::orderBy('tanggal_keberangkatan', 'desc')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required',
            'tanggal_keberangkatan' => 'required|date',
            'waktu_keberangkatan' => 'required',
            'kouta' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0'
        ]);

        TravelSchedule::create($request->all());

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dibuat!');
    }

    // TAMBAHKAN METHOD INI
    public function edit(TravelSchedule $schedule)
    {
        return view('admin.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, TravelSchedule $schedule)
    {
        $request->validate([
            'tujuan' => 'required',
            'tanggal_keberangkatan' => 'required|date',
            'waktu_keberangkatan' => 'required',
            'kouta' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0'
        ]);

        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy(TravelSchedule $schedule)
    {
        // Cek apakah ada booking yang terkait
        if ($schedule->bookings()->exists()) {
            return redirect()->route('admin.schedules.index')
                ->with('error', 'Tidak dapat menghapus jadwal yang sudah memiliki Pesanan.');
        }

        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}