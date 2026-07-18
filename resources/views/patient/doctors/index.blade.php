{{-- Halaman pencarian dokter untuk pasien --}}
@extends('layouts.app')
@section('title', 'Cari Dokter')
@section('content')
<h3 class="mb-3">Cari Dokter</h3>

<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <input type="text" name="specialization" class="form-control" placeholder="Cari spesialisasi..." value="{{ request('specialization') }}">
    </div>
    <div class="col-auto"><button class="btn btn-outline-primary">Cari</button></div>
</form>

<div class="row g-3">
    @forelse($doctors as $doctor)
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">{{ $doctor->user->name }}</h5>
                <p class="card-text text-muted mb-1">{{ $doctor->specialization }}</p>
                <p class="card-text small">Jadwal: {{ $doctor->schedules->pluck('day')->unique()->join(', ') ?: 'Belum ada jadwal' }}</p>
                <a href="{{ route('patient.bookings.create', $doctor) }}" class="btn btn-primary btn-sm">Reservasi Sekarang</a>
            </div>
        </div>
    </div>
    @empty
    <p class="text-muted">Tidak ada dokter ditemukan.</p>
    @endforelse
</div>
<div class="mt-3">{{ $doctors->links() }}</div>
@endsection
