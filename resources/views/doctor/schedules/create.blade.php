@extends('layouts.app')
@section('title', 'Tambah Jadwal')
@section('content')
<h3 class="mb-3">Tambah Jadwal Praktik</h3>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('doctor.schedules.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Hari</label>
            <select name="day" class="form-select" required>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $d)
                    <option value="{{ $d }}" @selected(old('day')===$d)>{{ $d }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Selesai</label>
            <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kuota Pasien per Sesi</label>
            <input type="number" name="quota" class="form-control" value="{{ old('quota', 10) }}" min="1" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('doctor.schedules.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div></div>
@endsection
