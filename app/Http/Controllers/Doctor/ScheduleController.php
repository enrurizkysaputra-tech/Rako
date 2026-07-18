<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $doctor = $request->user()->doctor;
        $schedules = Schedule::where('doctor_id', $doctor->id)->orderBy('day')->get();
        return view('doctor.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('doctor.schedules.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'quota' => 'required|integer|min:1|max:100',
        ]);

        $data['doctor_id'] = $request->user()->doctor->id;
        Schedule::create($data);

        return redirect()->route('doctor.schedules.index')->with('success', 'Jadwal praktik berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        $this->authorizeOwnership($schedule);
        return view('doctor.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $this->authorizeOwnership($schedule);

        $data = $request->validate([
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'quota' => 'required|integer|min:1|max:100',
        ]);

        $schedule->update($data);

        return redirect()->route('doctor.schedules.index')->with('success', 'Jadwal praktik berhasil diperbarui.');
    }

    public function destroy(Request $request, Schedule $schedule)
    {
        $this->authorizeOwnership($schedule);
        $schedule->delete();
        return redirect()->route('doctor.schedules.index')->with('success', 'Jadwal praktik berhasil dihapus.');
    }

    private function authorizeOwnership(Schedule $schedule): void
    {
        if ($schedule->doctor_id !== request()->user()->doctor->id) {
            abort(403);
        }
    }
}
