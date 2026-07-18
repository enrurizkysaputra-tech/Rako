<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin RAKO',
            'email' => 'admin@simoklin.test',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Dokter contoh
        $userDokter1 = User::create([
            'name' => 'dr. Ayu Lestari',
            'email' => 'ayu@simoklin.test',
            'password' => Hash::make('password123'),
            'role' => 'dokter',
            'phone' => '081234567890',
        ]);

        $doctor1 = Doctor::create([
            'user_id' => $userDokter1->id,
            'specialization' => 'Dokter Umum',
            'license_number' => 'SIP-001-2024',
            'is_active' => true,
        ]);

        Schedule::create(['doctor_id' => $doctor1->id, 'day' => 'Senin', 'start_time' => '08:00', 'end_time' => '12:00', 'quota' => 15]);
        Schedule::create(['doctor_id' => $doctor1->id, 'day' => 'Rabu', 'start_time' => '13:00', 'end_time' => '17:00', 'quota' => 15]);

        $userDokter2 = User::create([
            'name' => 'dr. Budi Santoso, Sp.A',
            'email' => 'budi@simoklin.test',
            'password' => Hash::make('password123'),
            'role' => 'dokter',
            'phone' => '081298765432',
        ]);

        $doctor2 = Doctor::create([
            'user_id' => $userDokter2->id,
            'specialization' => 'Spesialis Anak',
            'license_number' => 'SIP-002-2024',
            'is_active' => true,
        ]);

        Schedule::create(['doctor_id' => $doctor2->id, 'day' => 'Selasa', 'start_time' => '09:00', 'end_time' => '14:00', 'quota' => 10]);
        Schedule::create(['doctor_id' => $doctor2->id, 'day' => 'Kamis', 'start_time' => '09:00', 'end_time' => '14:00', 'quota' => 10]);

        // Pasien contoh
        User::create([
            'name' => 'Pasien Contoh',
            'email' => 'pasien@simoklin.test',
            'password' => Hash::make('password123'),
            'role' => 'pasien',
            'phone' => '081211112222',
        ]);
    }
}
