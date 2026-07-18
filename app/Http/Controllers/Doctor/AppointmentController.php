<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $doctorId = $request->user()->doctor->id;

        $query = Appointment::with(['patient', 'schedule'])->where('doctor_id', $doctorId);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $appointments = $query->latest('appointment_date')->paginate(15)->withQueryString();

        return view('doctor.appointments.index', compact('appointments'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        if ($appointment->doctor_id !== $request->user()->doctor->id) {
            abort(403);
        }

        $data = $request->validate([
            'status' => 'required|in:confirmed,completed,cancelled',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Saat dikonfirmasi, hitung nomor antrian & estimasi jam kedatangan
        if ($data['status'] === 'confirmed' && $appointment->status !== 'confirmed') {
            $lastQueueNumber = Appointment::where('doctor_id', $appointment->doctor_id)
                ->where('appointment_date', $appointment->appointment_date)
                ->whereIn('status', ['confirmed', 'completed'])
                ->max('queue_number');

            $queueNumber = ($lastQueueNumber ?? 0) + 1;

            $schedule = $appointment->schedule;
            $estimatedTime = \Carbon\Carbon::parse($schedule->start_time)
                ->addMinutes(($queueNumber - 1) * 15)
                ->format('H:i');

            $data['queue_number'] = $queueNumber;
            $data['estimated_time'] = $estimatedTime;
        }

        $appointment->update($data);

        return back()->with('success', 'Status reservasi berhasil diperbarui.');
    }

    public function markLate(Request $request, Appointment $appointment)
    {
        if ($appointment->doctor_id !== $request->user()->doctor->id) {
            abort(403);
        }

        if ($appointment->status !== 'confirmed') {
            return back()->with('error', 'Hanya reservasi berstatus confirmed yang bisa ditandai terlambat.');
        }

        $appointment->update([
            'status' => 'cancelled',
            'notes' => 'Pasien tidak hadir/terlambat sesuai jam estimasi yang ditentukan.',
        ]);

        return back()->with('success', 'Reservasi ditandai sebagai tidak hadir/terlambat dan otomatis dibatalkan.');
    }
}