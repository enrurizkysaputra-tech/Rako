@extends('layouts.app')
@section('title', 'Reservasi Masuk')
@section('content')
<h3 class="mb-3">Reservasi Masuk</h3>

<form method="GET" class="row g-2 mb-3">
    <div class="col-auto">
        <select name="status" class="form-select">
            <option value="">-- Semua Status --</option>
            @foreach(['pending','confirmed','completed','cancelled'] as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-auto"><button class="btn btn-outline-primary">Filter</button></div>
</form>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table align-middle">
            <thead><tr><th>Tanggal</th><th>Pasien</th><th>Keluhan</th><th>Antrian</th><th>Est. Jam</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($appointments as $a)
                <tr>
                    <td>{{ $a->appointment_date->format('d-m-Y') }}</td>
                    <td>{{ $a->patient->name }}</td>
                    <td>{{ $a->complaint ?? '-' }}</td>
                    <td>{{ $a->queue_number ? '#'.$a->queue_number : '-' }}</td>
                    <td>{{ $a->estimated_time ? \Carbon\Carbon::parse($a->estimated_time)->format('H:i') : '-' }}</td>
                    <td><span class="badge bg-info text-dark text-capitalize">{{ $a->status }}</span></td>
                    <td>
                        @if($a->status === 'pending')
                        <form action="{{ route('doctor.appointments.updateStatus', $a) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="confirmed">
                            <button class="btn btn-sm btn-success">Konfirmasi</button>
                        </form>
                        <form action="{{ route('doctor.appointments.updateStatus', $a) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="cancelled">
                            <button class="btn btn-sm btn-outline-danger">Tolak</button>
                        </form>
                        @elseif($a->status === 'confirmed')
                        <form action="{{ route('doctor.appointments.updateStatus', $a) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="completed">
                            <button class="btn btn-sm btn-primary">Tandai Selesai</button>
                        </form>
                        <form action="{{ route('doctor.appointments.markLate', $a) }}" method="POST" class="d-inline" onsubmit="return confirm('Tandai pasien ini terlambat/tidak hadir? Reservasi akan otomatis dibatalkan.')">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-outline-warning">Tandai Terlambat</button>
                        </form>
                        @elseif($a->status === 'completed')
                            @if($a->medicalRecord)
                                <span class="text-muted small">Rekam medis tersimpan</span>
                            @else
                                <a href="{{ route('doctor.medical-records.create', $a) }}" class="btn btn-sm btn-outline-primary">Isi Rekam Medis</a>
                            @endif
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">Belum ada reservasi</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $appointments->links() }}
    </div>
</div>
@endsection