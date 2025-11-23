<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelSchedule;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $schedules = TravelSchedule::withCount(['bookings as total_penumpang' => function($query) {
            $query->where('status_pembayaran', 'paid');
        }])->orderBy('tanggal_keberangkatan', 'desc')->get();

        return view('admin.reports.index', compact('schedules'));
    }
}