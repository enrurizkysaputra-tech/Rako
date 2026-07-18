@extends('layouts.app')
@section('title', 'Semua Reservasi')
@section('content')
<h3 class="mb-3">Semua Reservasi</h3>

<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <select name="status" class="form-select">
            <option value="">-- Semua Status --</option>
            @foreach(['pending','confirmed','completed','cancelled'] as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto">
        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
    </div>
    <div class="col-auto">
        <button class="btn btn-outline-primary">Filter</button>
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table align-middle">
            <thead>
                <tr><th>Tanggal</th><th>Pasien</th><th>Dokter</th><th>Jadwal</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse($appointments as $a)
                <tr>
                    <td>{{ $a->appointment_date->format('d-m-Y') }}</td>
                    <td>{{ $a->patient->name }}</td>
                    <td>{{ $a->doctor->user->name }}</td>
                    <td>{{ $a->schedule->day }} {{ $a->schedule->start_time }}-{{ $a->schedule->end_time }}</td>
                    <td><span class="badge bg-info text-dark text-capitalize">{{ $a->status }}</span></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data booking</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $appointments->links() }}
    </div>
</div>
@endsection
