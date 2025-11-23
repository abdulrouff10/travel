<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'metode_pembayaran', 
        'jumlah_bayar',
        'waktu_pembayaran',
        'bukti_pembayaran'
    ];

    // Relationship dengan Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}