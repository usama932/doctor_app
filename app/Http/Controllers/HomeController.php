<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\Review;
use App\Models\Settings;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function welcome()
    {
        return view('welcome', [
            'doctors' => User::query()->where('user_type', 'D')->take('8')->inRandomOrder()->get(),
            'setting' => Settings::query()->first(),
            'specialities' => Speciality::query()->orderByDesc('id')->get(),
        ]);

    }
    public function index()
    {
        $user = Auth::user();
        $upcommingAppointments = Appointment::query()
            ->where("appointment_date", ">=", date("Y-m-d"))
            ->orderBy("appointment_date", "ASC");

        if (Auth::user()->is_admin()){
            $hospitalCount = Hospital::count();
            $patientCount = User::where("user_type", "U")->count();
            $doctorCount = User::where("user_type", "D")->count();
            $appointmentCount = Appointment::count();
            $specialityCount = Speciality::count();
            $totalRevenue = Appointment::select(
                    DB::raw('sum(appointments.fee+((appointments.fee*appointments.vat) /100)) as total_fee')
                )->where("payment_status","Paid")->first();
            $todayAppointments = Appointment::query()
            ->with(["doctor.speciality", "patient", "hospital"])
            ->where('appointment_date', today())
            ->take(10)->get();
            return view('admin.home', [
                'admin' => User::find(Auth::id()),
                "hospitalCount" => $hospitalCount,
                "patientCount" => $patientCount,
                "doctorCount" => $doctorCount,
                "specialityCount" => $specialityCount,
                "appointmentCount" => $appointmentCount,
                "totalRevenue" => $totalRevenue,
                "todayAppointments" => $todayAppointments,
            ]);
        }elseif (Auth::user()->is_hospital()){
            $upcommingAppointments->where("hospital_id", $user->hospital_id);
            $user->load(["hospital.doctors", "hospital.distinctPatients", "hospital.appointments"]);
            $todayAppointments = Appointment::query()
            ->where('hospital_id', $user->hospital_id)
            ->where('appointment_date', today())
            ->paginate(10);
            return view('hospital.home',[
                'upcommingAppointments' => $upcommingAppointments->paginate(10),
                'todayAppointments' => $todayAppointments,
                'doctorCount' => $user->hospital->doctors->count(),
                'patientCount' => $user->hospital->distinctPatients->count(),
                "appointmentCount" => $user->hospital->appointments->count(),
            ]);
        }elseif (Auth::user()->is_doctor()){
            $upcommingAppointments->where('doctor_id', Auth::id());
            $appointmentCount = $user->appointments()->count();
            $user->load("appointments.patient");
            $patientCount = $user->appointments->map(function($item){
                return $item->patient;
            })->unique("id")->count();
            $todayAppointments = Appointment::query()
                    ->where('doctor_id', Auth::id())
                    ->where('appointment_date', today())
                    ->paginate(10);
            return view('doctor.home',
            [
                "appointmentCount" => $appointmentCount,
                "patientCount" => $patientCount,
                "todayAppointmentCount" => $patientCount,
                'upcommingappointments' => $upcommingAppointments->paginate(10),
                'today_appointments' => $todayAppointments,
            ]);
        }elseif (Auth::user()->is_pharmacy()){
            return view('pharmacy-admin.home');
        }else{
            return view('patient.home', [
                'doctors' => User::query()->where('user_type', 'D')->take('8')->inRandomOrder()->get(),
                'setting' => Settings::query()->first(),
                'specialities' => Speciality::query()->orderByDesc('id')->get(),
            ]);
        }
    }
    public function optimize()
    {
        Artisan::call('optimize:clear');
        echo 'Optimize command executed successfully.';
    }
    public function migrate()
    {
        Artisan::call('migrate');
        // Artisan::call('migrate:fresh --seed');
        echo 'Migration Command Executed successfully';
    }

    // Patient functions
    public function search_doctor()
    {
//        $doctor = User::query()->where('user_type', 'D')->filter(request(['search', 'gender', 'speciality_id']))->get();
            return view('patient.doctor.search',
                [
                    'doctors' => User::latest()->where('user_type', 'D')->filter(request(['search', 'gender', 'speciality_id']))->get(),
                    'specialities' => Speciality::query()->orderBy('name')->get(),
                ]);
    }
    public function search_doctor_index()
    {
        return view('patient.doctor.search_index', [
           'doctors' => User::latest()->where('user_type', 'D')->get(),
           'specialities' => Speciality::query()->orderBy('name')->get(),
        ]);
    }
    public function search_pharmacy()
    {
        return view('patient.pharmacy.search');
    }

    public function doctor_profile($id)
    {
        $reviews = Review::query()->where('doctor_id', $id)->get();
        $review_sum = Review::where('doctor_id', $id)->sum('star_rated');
        if ($reviews->count() > 0)
        {
            $review_value = $review_sum/$reviews->count();
        }else
        {
            $review_value = 0;
        }
        return view('patient.doctor.profile', [
            'doctor' => User::find($id),
            'reviews' => $reviews,
            'review_value' => $review_value
        ]);
    }
}
