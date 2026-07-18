@extends('layouts.app')
@section('title', 'Reservasi Dokter')
@section('content')
<h3 class="mb-1">Reservasi — {{ $doctor->user->name }}</h3>
<p class="text-muted mb-3">{{ $doctor->specialization }}</p>

<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('patient.bookings.store', $doctor) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Pilih Jadwal</label>
            <select name="schedule_id" class="form-select" required>
                <option value="">-- Pilih Jadwal --</option>
                @foreach($doctor->schedules as $s)
                    <option value="{{ $s->id }}" @selected(old('schedule_id')==$s->id)>
                        {{ $s->day }}, {{ $s->start_time }} - {{ $s->end_time }} (kuota {{ $s->quota }})
                    </option>
                @endforeach
            </select>
            @if($doctor->schedules->isEmpty())
                <div class="form-text text-danger">Dokter ini belum memiliki jadwal praktik.</div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Kunjungan</label>
            <input type="date" name="appointment_date" class="form-control" min="{{ date('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
            <div class="form-text">Pastikan tanggal yang dipilih sesuai dengan hari pada jadwal di atas.</div>
        </div>
        <div class="mb-3">
            <label class="form-label">Keluhan (opsional)</label>
            <textarea name="complaint" class="form-control" rows="3">{{ old('complaint') }}</textarea>
        </div>
        <button class="btn btn-primary" @disabled($doctor->schedules->isEmpty())>Kirim Reservasi</button>
        <a href="{{ route('patient.doctors.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div></div>
@endsection
