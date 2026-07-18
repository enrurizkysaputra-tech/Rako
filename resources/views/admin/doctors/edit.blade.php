@extends('layouts.app')
@section('title', 'Edit Dokter')
@section('content')
<h3 class="mb-3">Edit Dokter</h3>
<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.doctors.update', $doctor) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->user->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->user->email) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password Baru (opsional)</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" minlength="8" placeholder="Kosongkan jika tidak ingin mengubah password">
                    <button class="btn btn-outline-secondary" type="button" onclick="toggleAdminPassword('password', this)">👁️</button>
                </div>
                <div class="form-text">Isi hanya jika ingin mengganti password dokter ini.</div>
            </div>
            <div class="mb-3">
                <label class="form-label">No. Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->user->phone) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Spesialisasi</label>
                <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $doctor->specialization) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor Izin Praktik</label>
                <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $doctor->license_number) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Foto Profil (opsional, upload untuk ganti)</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" @selected($doctor->is_active)>Aktif</option>
                    <option value="0" @selected(!$doctor->is_active)>Nonaktif</option>
                </select>
            </div>
            <button class="btn btn-primary">Simpan Perubahan</button>
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
