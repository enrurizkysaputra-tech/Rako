<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::with(['doctor.user', 'schedule', 'medicalRecord'])
            ->where('patient_id', $request->user()->id)
            ->latest('appointment_date')
            ->paginate(10);

        return view('patient.bookings.index', compact('appointments'));
    }
}
