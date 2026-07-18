@extends('layouts.app')
@section('title', 'Isi Rekam Medis')
@section('content')
<h3 class="mb-3">Rekam Medis — {{ $appointment->patient->name }}</h3>
<p class="text-muted">Tanggal kunjungan: {{ $appointment->appointment_date->format('d-m-Y') }}</p>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('doctor.medical-records.store', $appointment) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Diagnosis</label>
            <textarea name="diagnosis" class="form-control" rows="3" required>{{ old('diagnosis') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Catatan / Anjuran / Resep</label>
            <textarea name="treatment_notes" class="form-control" rows="3">{{ old('treatment_notes') }}</textarea>
        </div>
        <button class="btn btn-primary">Simpan Rekam Medis</button>
        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div></div>
@endsection
