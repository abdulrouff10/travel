<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'travel_schedule_id',
        'jumlah_tiket',
        'total_harga',
        'status_pembayaran'
    ];

        // Tambahkan di Booking model:
    protected $casts = [
        'total_harga' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function travelSchedule()
    {
        return $this->belongsTo(TravelSchedule::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}