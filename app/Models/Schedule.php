<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 'day', 'start_time', 'end_time', 'quota',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Berapa banyak appointment aktif (bukan cancelled) pada tanggal tertentu untuk slot ini
    public function bookedCount(string $date): int
    {
        return $this->appointments()
            ->where('appointment_date', $date)
            ->where('status', '!=', 'cancelled')
            ->count();
    }

    public function isFull(string $date): bool
    {
        return $this->bookedCount($date) >= $this->quota;
    }
}
