<?php

namespace Database\Seeders;

use App\Models\TravelSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TravelScheduleSeeder extends Seeder
{
    public function run()
    {
        $schedules = [
            [
                'tujuan' => 'Jakarta - Bandung',
                'tanggal_keberangkatan' => Carbon::now()->addDays(2),
                'waktu_keberangkatan' => '08:00:00',
                'kouta' => 15,
                'harga' => 75000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tujuan' => 'Bandung - Yogyakarta',
                'tanggal_keberangkatan' => Carbon::now()->addDays(3),
                'waktu_keberangkatan' => '10:30:00',
                'kouta' => 12,
                'harga' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tujuan' => 'Surabaya - Malang',
                'tanggal_keberangkatan' => Carbon::now()->addDays(1),
                'waktu_keberangkatan' => '07:00:00',
                'kouta' => 10,
                'harga' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tujuan' => 'Yogyakarta - Semarang',
                'tanggal_keberangkatan' => Carbon::now()->addDays(4),
                'waktu_keberangkatan' => '09:15:00',
                'kouta' => 8,
                'harga' => 80000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tujuan' => 'Medan - Padang',
                'tanggal_keberangkatan' => Carbon::now()->addDays(5),
                'waktu_keberangkatan' => '14:00:00',
                'kouta' => 20,
                'harga' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        TravelSchedule::insert($schedules);
    }
}