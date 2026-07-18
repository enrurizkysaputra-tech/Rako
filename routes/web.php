// Routing utama aplikasi RAKO - dikelompokkan per role: admin, dokter, pasien
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Doctor\ScheduleController as DoctorScheduleController;
use App\Http\Controllers\Doctor\AppointmentController as DoctorAppointmentController;
use App\Http\Controllers\Doctor\MedicalRecordController;
use App\Http\Controllers\Patient\DoctorListController;
use App\Http\Controllers\Patient\BookingController;
use App\Http\Controllers\Patient\HistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Redirect setelah login, sesuai role (dipanggil dari Breeze LoginResponse / dashboard route)
Route::middleware('auth')->get('/dashboard', [HomeController::class, 'redirectAfterLogin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------- ADMIN ----------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/doctors', [AdminDoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [AdminDoctorController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [AdminDoctorController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/{doctor}/edit', [AdminDoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/{doctor}', [AdminDoctorController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors/{doctor}', [AdminDoctorController::class, 'destroy'])->name('doctors.destroy');

    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
});

// ---------- DOCTOR ----------
Route::middleware(['auth', 'role:dokter'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/schedules', [DoctorScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/create', [DoctorScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [DoctorScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{schedule}/edit', [DoctorScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{schedule}', [DoctorScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{schedule}', [DoctorScheduleController::class, 'destroy'])->name('schedules.destroy');

    Route::get('/appointments', [DoctorAppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}/status', [DoctorAppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::patch('/appointments/{appointment}/mark-late', [DoctorAppointmentController::class, 'markLate'])->name('appointments.markLate');

    Route::get('/appointments/{appointment}/medical-record', [MedicalRecordController::class, 'create'])->name('medical-records.create');
    Route::post('/appointments/{appointment}/medical-record', [MedicalRecordController::class, 'store'])->name('medical-records.store');
});

// ---------- PATIENT ----------
Route::middleware(['auth', 'role:pasien'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/doctors', [DoctorListController::class, 'index'])->name('doctors.index');

    Route::get('/doctors/{doctor}/book', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/doctors/{doctor}/book', [BookingController::class, 'store'])->name('bookings.store');

    Route::get('/bookings', [HistoryController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{appointment}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

require __DIR__.'/auth.php';
