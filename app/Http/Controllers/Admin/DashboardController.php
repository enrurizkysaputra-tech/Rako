<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDoctors = Doctor::where('is_active', true)->count();
        $totalAppointments = Appointment::count();

        $statusCounts = Appointment::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $monthly = Appointment::select(
            DB::raw("strftime('%Y-%m', appointment_date) as bulan"),
            DB::raw('count(*) as total')
        )
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();
        
        return view('admin.dashboard', compact('totalDoctors', 'totalAppointments', 'statusCounts', 'monthly'));
    }
}
