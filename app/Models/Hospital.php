<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = ['hospital_name', 'address','city', 'country', 'state', 'zip', 'image'];

    public function adminUser(){
        return $this->hasOne(User::class, "hospital_id", "id");
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function doctors(){
        return $this->hasMany(User::class, "hospital_id", "id")->where("user_type", "D");
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, "hospital_id", "id");
    }

    public function distinctPatients(){
        // return $this->through("appointments")->has("patient");
        return $this->hasManyThrough(User::class, Appointment::class,
            "hospital_id", "id", "id", "patient_id")->where("user_type", "U")->distinct();
    }
    public function scheduleSetting()
    {
        return $this->hasOne(ScheduleSetting::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function blogs(){
        return $this->hasManyThrough(Blog::class, User::class, "hospital_id", "doctor_id", "id", "id");
    }
}
