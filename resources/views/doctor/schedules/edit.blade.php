@extends('layouts.app')
@section('title', 'Edit Jadwal')
@section('content')
<h3 class="mb-3">Edit Jadwal Praktik</h3>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('doctor.schedules.update', $schedule) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label">Hari</label>
            <select name="day" class="form-select" required>
                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $d)
                    <option value="{{ $d }}" @selected($schedule->day===$d)>{{ $d }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Selesai</label>
            <input type="time" name="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kuota Pasien per Sesi</label>
            <input type="number" name="quota" class="form-control" value="{{ $schedule->quota }}" min="1" required>
        </div>
        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('doctor.schedules.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div></div>
@endsection
