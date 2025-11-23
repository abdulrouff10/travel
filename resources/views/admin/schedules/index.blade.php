@extends('layouts.app')

@section('title', 'Kelola Jadwal Travel')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
</div>

@if($schedules->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tujuan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Kouta</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->tujuan }}</td>
                    <td>{{ $schedule->tanggal_keberangkatan->format('d/m/Y') }}</td>
                    <td>
                        @php
                            // Format waktu hanya jam dan menit
                            $waktu = \Carbon\Carbon::createFromFormat('H:i:s', $schedule->waktu_keberangkatan)->format('H:i');
                            @endphp
                            {{ $waktu }}
                        </td>
                    <td>
                        <span class="{{ $schedule->kouta_tersedia == 0 ? 'text-danger' : '' }}">
                            {{ $schedule->kouta_tersedia }}/{{ $schedule->kouta }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($schedule->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('admin.schedules.edit', $schedule) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="alert alert-info">
        Belum ada jadwal travel. <a href="{{ route('admin.schedules.create') }}">Buat jadwal pertama</a>
    </div>
@endif
@endsection