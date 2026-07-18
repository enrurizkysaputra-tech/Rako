<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorListController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::with(['user', 'schedules'])->where('is_active', true);

        if ($request->filled('specialization')) {
            $query->where('specialization', 'like', '%' . $request->specialization . '%');
        }

        $doctors = $query->paginate(9)->withQueryString();

        return view('patient.doctors.index', compact('doctors'));
    }
}
