@extends('layouts.app')
@section('title', 'Data Dokter')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Dokter</h3>
    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">+ Tambah Dokter</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table align-middle">
            <thead>
                <tr><th>Nama</th><th>Email</th><th>Spesialisasi</th><th>No. Izin</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->user->name }}</td>
                    <td>{{ $doctor->user->email }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>{{ $doctor->license_number ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $doctor->is_active ? 'bg-success' : 'bg-secondary' }}">
                            {{ $doctor->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus dokter ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">Belum ada data dokter</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $doctors->links() }}
    </div>
</div>
@endsection
