@extends('layouts.app')
@section('title', 'Riwayat Reservasi')
@section('content')
<h3 class="mb-3">Riwayat Reservasi Saya</h3>

<div class="card shadow-sm"><div class="card-body">
    <table class="table align-middle">
        <thead><tr><th>Tanggal</th><th>Dokter</th><th>Antrian</th><th>Est. Jam</th><th>Status</th><th>Rekam Medis</th></tr></thead>
        <tbody>
            @forelse($appointments as $a)
            <tr>
                <td>{{ $a->appointment_date->format('d-m-Y') }}</td>
                <td>{{ $a->doctor->user->name }} ({{ $a->doctor->specialization }})</td>
                <td>{{ $a->queue_number ? '#'.$a->queue_number : '-' }}</td>
                <td>{{ $a->estimated_time ? \Carbon\Carbon::parse($a->estimated_time)->format('H:i') : '-' }}</td>
                <td>
                    <span class="badge bg-info text-dark text-capitalize">{{ $a->status }}</span>
                    @if($a->status === 'pending')
                        <form action="{{ route('patient.bookings.cancel', $a) }}" method="POST" class="d-inline mt-1" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-outline-danger d-block mt-1">Batalkan</button>
                        </form>
                    @endif
                </td>
                <td>
                    @if($a->medicalRecord)
                        <details>
                            <summary class="btn btn-sm btn-outline-secondary">Lihat</summary>
                            <div class="mt-2 small">
                                <strong>Diagnosis:</strong> {{ $a->medicalRecord->diagnosis }}<br>
                                <strong>Catatan:</strong> {{ $a->medicalRecord->treatment_notes ?? '-' }}
                            </div>
                        </details>
                    @else
                        <span class="text-muted small">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted">Belum ada riwayat reservasi</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $appointments->links() }}
</div></div>
@endsection