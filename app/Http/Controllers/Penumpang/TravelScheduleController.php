<?php

namespace App\Http\Controllers\Penumpang;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;

class TravelScheduleController extends Controller
{
    public function index()
    {
        $schedules = TravelSchedule::where('tanggal_keberangkatan', '>=', now()->toDateString())
                                  ->get();
        return view('penumpang.schedules.index', compact('schedules'));
    }
}