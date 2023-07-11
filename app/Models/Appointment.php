<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['doctor_id', 'patient_id', 'hospital_id', 'appointment_time',
    'appointment_date', 'fee', 'discount', 'vat', 'status', 'payment_status', 'payment_date', 'status_changed_by'];

    public function user()
    {
        return $this->belongsTo(User::class, "patient_id", 'id');
    }
    public function patient()
    {
        return $this->belongsTo(User::class, "patient_id", 'id');
    }
    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'hospital_id', 'id');
    }
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
    public function invoiceStatusChangedBy(){
        return $this->belongsTo(User::class, "status_changed_by", "id");
    }
}
