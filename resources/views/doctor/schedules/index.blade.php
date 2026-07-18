@extends('layouts.app')
@section('title', 'Jadwal Praktik')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Jadwal Praktik Saya</h3>
    <a href="{{ route('doctor.schedules.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table align-middle">
            <thead><tr><th>Hari</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Kuota</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($schedules as $s)
                <tr>
                    <td>{{ $s->day }}</td>
                    <td>{{ $s->start_time }}</td>
                    <td>{{ $s->end_time }}</td>
                    <td>{{ $s->quota }}</td>
                    <td>
                        <a href="{{ route('doctor.schedules.edit', $s) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('doctor.schedules.destroy', $s) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada jadwal</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
