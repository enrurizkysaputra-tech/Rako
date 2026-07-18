<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function create(Request $request, Appointment $appointment)
    {
        $this->authorizeOwnership($appointment, $request);

        if ($appointment->status !== 'completed') {
            return back()->with('error', 'Rekam medis hanya bisa diisi setelah appointment berstatus completed.');
        }

        return view('doctor.medical-records.create', compact('appointment'));
    }

    public function store(Request $request, Appointment $appointment)
    {
        $this->authorizeOwnership($appointment, $request);

        $data = $request->validate([
            'diagnosis' => 'required|string|max:2000',
            'treatment_notes' => 'nullable|string|max:2000',
        ]);

        $data['appointment_id'] = $appointment->id;

        $appointment->medicalRecord()->updateOrCreate(['appointment_id' => $appointment->id], $data);

        return redirect()->route('doctor.appointments.index')->with('success', 'Rekam medis berhasil disimpan.');
    }

    private function authorizeOwnership(Appointment $appointment, Request $request): void
    {
        if ($appointment->doctor_id !== $request->user()->doctor->id) {
            abort(403);
        }
    }
}
