@extends('layouts.app')

@section('title', 'Tambah Jadwal Travel')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Tambah Jadwal Travel</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.schedules.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan Travel</label>
                        <input type="text" class="form-control" id="tujuan" name="tujuan" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                        <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="waktu_keberangkatan" class="form-label">Waktu Keberangkatan</label>
                        <input type="time" class="form-control" id="waktu_keberangkatan" name="waktu_keberangkatan" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="kouta" class="form-label">Kouta Penumpang</label>
                        <input type="number" class="form-control" id="kouta" name="kouta" min="1" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Tiket (Rp)</label>
                        <input type="number" class="form-control" id="harga" name="harga" min="0" required>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                        <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection