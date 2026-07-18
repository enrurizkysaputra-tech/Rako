@extends('layouts.app')
@section('title', 'Tambah Dokter')
@section('content')
<h3 class="mb-3">Tambah Dokter</h3>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.doctors.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
           <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required minlength="8">
                    <button class="btn btn-outline-secondary" type="button" onclick="toggleAdminPassword('password', this)">👁️</button>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Spesialisasi</label>
                <input type="text" name="specialization" class="form-control" value="{{ old('specialization') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor Izin Praktik</label>
                <input type="text" name="license_number" class="form-control" value="{{ old('license_number') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Profil</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<script>
    function toggleAdminPassword(fieldId, btn) {
        const field = document.getElementById(fieldId);
        if (field.type === 'password') {
            field.type = 'text';
            btn.textContent = '🙈';
        } else {
            field.type = 'password';
            btn.textContent = '👁️';
        }
    }
</script>
@endsection
