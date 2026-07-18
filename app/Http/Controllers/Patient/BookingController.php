<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;

/**
 * Controller untuk menangani proses reservasi klinik oleh pasien,
 * termasuk pembatalan reservasi.
 */
class BookingController extends Controller
{
    // Form booking untuk dokter tertentu
    public function create(Doctor $doctor)
    {
        $doctor->load('schedules');
        return view('patient.bookings.create', compact('doctor'));
    }

    public function store(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'complaint' => 'nullable|string|max:1000',
        ]);

        $schedule = Schedule::where('id', $data['schedule_id'])
            ->where('doctor_id', $doctor->id)
            ->firstOrFail();

        // Validasi hari yang dipilih sesuai dengan hari jadwal
        $dayMap = ['Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu'];
        $chosenDay = $dayMap[date('l', strtotime($data['appointment_date']))];

        if ($chosenDay !== $schedule->day) {
            return back()->withInput()->with('error', 'Tanggal yang dipilih tidak sesuai dengan hari jadwal (' . $schedule->day . ').');
        }

        if ($schedule->isFull($data['appointment_date'])) {
            return back()->withInput()->with('error', 'Kuota untuk slot jadwal ini sudah penuh, silakan pilih tanggal/slot lain.');
        }

        Appointment::create([
            'patient_id' => $request->user()->id,
            'doctor_id' => $doctor->id,
            'schedule_id' => $schedule->id,
            'appointment_date' => $data['appointment_date'],
            'complaint' => $data['complaint'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('patient.bookings.index')->with('success', 'Reservasi berhasil dikirim, menunggu konfirmasi dokter.');
    }
    public function cancel(Request $request, \App\Models\Appointment $appointment)
    {
        if ($appointment->patient_id !== $request->user()->id) {
            abort(403);
        }

        if ($appointment->status !== 'pending') {
            return back()->with('error', 'Reservasi hanya bisa dibatalkan selama masih berstatus pending.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
