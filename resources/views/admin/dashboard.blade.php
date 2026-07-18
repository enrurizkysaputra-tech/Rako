@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
<h3 class="mb-4">Dashboard Admin</h3>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-muted">Dokter Aktif</div>
                <div class="fs-2 fw-bold">{{ $totalDoctors }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-muted">Total Reservasi</div>
                <div class="fs-2 fw-bold">{{ $totalAppointments }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-muted">Pending</div>
                <div class="fs-2 fw-bold">{{ $statusCounts['pending'] ?? 0 }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header">Ringkasan Status Reservasi</div>
    <div class="card-body">
        <table class="table mb-0">
            <thead><tr><th>Status</th><th>Jumlah</th></tr></thead>
            <tbody>
                @foreach(['pending','confirmed','completed','cancelled'] as $status)
                <tr><td class="text-capitalize">{{ $status }}</td><td>{{ $statusCounts[$status] ?? 0 }}</td></tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header">Reservasi per Bulan</div>
    <div class="card-body">
        <table class="table mb-0">
            <thead><tr><th>Bulan</th><th>Jumlah Reservasi</th></tr></thead>
            <tbody>
                @forelse($monthly as $row)
                <tr><td>{{ $row->bulan }}</td><td>{{ $row->total }}</td></tr>
                @empty
                <tr><td colspan="2" class="text-center text-muted">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
