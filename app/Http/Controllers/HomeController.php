<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Dipanggil setelah login berhasil, redirect sesuai role
    public function redirectAfterLogin(Request $request)
    {
        $user = $request->user();

        return match ($user->role) {
            'admin'  => redirect()->route('admin.dashboard'),
            'dokter' => redirect()->route('doctor.appointments.index'),
            default  => redirect()->route('patient.doctors.index'),
        };
    }
}
