<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'tujuan',
        'tanggal_keberangkatan',
        'waktu_keberangkatan',
        'kouta',
        'harga'
    ];

        // Tambahkan di TravelSchedule model:
    protected $casts = [
        'tanggal_keberangkatan' => 'date',
        'harga' => 'decimal:2'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getKoutaTersediaAttribute()
    {
        $terpakai = $this->bookings()->where('status_pembayaran', 'paid')->sum('jumlah_tiket');
        return $this->kouta - $terpakai;
    }
}