<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hospital_id',
        'speciality_id',
        'name',
        'username',
        'profile_image',
        'description',
        'address',
        'country',
        'state',
        'zip_code',
        'date_of_birth',
        'gender',
        'age',
        'blood_group',
        'email',
        'mobile',
        'user_type',
        'password',
        'pricing',
        'twitter',
        'facebook',
        'linkedin',
        'pinterest',
        'instagram',
        'youtube',
        "status",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        "profile_image" => "placeholder.png",
    ];

    // User Types
    public const ADMIN = 'A';
    public const HOSPITAL = 'H';
    public const DOCTOR = 'D';
    public const PATIENT = 'U';
    public const PHARMACY = 'P';

    public function is_admin()
    {
        return $this->user_type == User::ADMIN;
    }

    public function is_hospital()
    {
        return $this->user_type == User::HOSPITAL;
    }

    public function is_doctor()
    {
        return $this->user_type == User::DOCTOR;
    }

    public function is_patient()
    {
        return $this->user_type == User::PATIENT;
    }

    public function is_pharmacy()
    {
        return $this->user_type == User::PHARMACY;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'], fn($query, $search) => $query
            ->where('address', 'like', '%' . $search . '%')
        );
        $query->when($filters['gender'], fn($query, $gender) => $query
            ->where('gender', 'like', '%' . request('gender') . '%')
        );
        $query->when($filters['speciality_id'], fn($query, $speciality_id) => $query
            ->where('speciality_id', request('speciality_id')));
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, "hospital_id", "id");
    }

    public function doctors(){
        return $this->hasMany(User::class, 'hospital_id', 'hospital_id')
                ->where('user_type', 'D');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, "speciality_id");
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }

    public function clinics()
    {
        return $this->hasMany(Clinic::class);
    }

    public function appointments()
    {
        if(auth()->user()->user_type == User::HOSPITAL){
            return $this->hasMany(Appointment::class, "hospital_id");
        }
        if(auth()->user()->user_type == User::DOCTOR){
            return $this->hasMany(Appointment::class, "doctor_id");
        }
        return $this->hasMany(Appointment::class, "patient_id");
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function regularAvailabilities(){
        return $this->hasMany(RegularAvailability::class, "doctor_id", "id");
    }
    public function oneTimeailabilities(){
        return $this->hasMany(OneTimeAvailability::class, "doctor_id", "id");
    }
    public function unavailailities(){
        return $this->hasMany(Unavailability::class, "doctor_id", "id");
    }
    // Attributes
    public function getAgeAttribute(){
        if($this->date_of_birth){
            return \Carbon\Carbon::parse($this->date_of_birth)->age;
        }
        return 0;
    }

}
