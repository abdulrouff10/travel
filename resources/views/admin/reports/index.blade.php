@extends('layouts.app')

@section('title', 'Laporan Penumpang')

@section('content')

@if($schedules->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Jadwal Travel</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Jumlah Penumpang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->tujuan }}</td>
                    <td>{{ $schedule->tanggal_keberangkatan->format('d/m/Y') }}</td>
                    <td>{{ $schedule->total_penumpang }} orang</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info">
        Belum ada laporan penumpang.
    </div>
@endif
@endsection