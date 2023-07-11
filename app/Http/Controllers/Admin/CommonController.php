<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Hospital;
use App\Models\ScheduleSetting;
use App\Models\Service;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class  CommonController extends Controller
{
    // Return view for doctor create
    public function doctor_services()
    {
        return view('doctor.profile.services-create', [
            'services' => Service::query()->where('user_id', Auth::id())->get(),
        ]);
    }

    // Store services data on table
    public function store_services(Request $request)
    {
        $services = $request->get('titles');
        if ($old_service = Service::where('user_id', Auth::id()))
        {
            $old_service->delete();
        }
        foreach ($services as $i => $service)
        {
            if (filled($service)){
                Service::create([
                    'user_id' => Auth::id(),
                    'service_title' => $service,
                ]);
            }
        }
        return redirect()
            ->route('profile.index')
            ->with('flash', ['type', 'success', 'message' => 'Services added Successfully']);
    }

    // Return view for Specializaiton create
    public function doctor_specializations()
    {
        return view('doctor.profile.specialization-create',
        [
           'specializations' => Specialization::query()->where('user_id', Auth::id())->get(),
        ]);
    }

    // Store Specialization of doctors on table
    public function store_specialization(Request $request)
    {
        $specializations = $request->get('specialization_titles');
        if ($spec = Specialization::where('user_id', Auth::id()))
        {
            $spec->delete();
        }
        foreach ($specializations as $i=>$specialization)
        {
            if (!empty($specialization[$i])){
                Specialization::create([
                    'user_id' => Auth::id(),
                    'specialization_title' => $specialization,
                ]);
            }
        }
        return redirect()
            ->route('profile.index')
            ->with('flash', ['type', 'success', 'message' => 'Specialization added Succcessfully']);
    }

    // Add Clinic Details
    public function clinic_details()
    {
        return view('doctor.profile.clinic.create');
    }

    public function store_clinic(Request $request)
    {
        $attributes = $request->validate([
           'user_id' => 'required',
           'clinic_title' => 'required',
           'clinic_location' => 'required',
           'clinic_fee' => 'required',
           'clinic_start_time' => 'required',
           'clinic_end_time' => 'required'
        ]);

        Clinic::create($attributes);

        return redirect()
            ->route('profile.index')
            ->with('flash', ['type', 'success', 'message' => 'Clinic Details Added Successfully']);
    }

    // Change Password
    public function change_password()
    {
        if (Auth::user()->is_admin())
        {
            return view('admin.profile.change-password');
        }elseif(Auth::user()->is_hospital())
        {
            return view('hospital.profile.change-password');
        }elseif(Auth::user()->is_doctor())
        {
            return view('doctor.profile.change-password');
        }elseif(Auth::user()->is_patient())
        {
            return view('patient.profile.change-password');
        }
    }

    public function store_new_password(Request $request)
    {
        $request->validate([
           'current_password' => ['required', function($attributer, $value, $fail){
            if (!Hash::check($value, Auth::user()->password)){
                $fail('Old Password didn\'t match');
            }
           },],
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        User::find(Auth::id())->update(['password' => Hash::make($request->new_password)]);

        return redirect()
            ->route('profile.index')
            ->with('flash', ['type', 'success', 'message' => 'Password Changed Successfully']);
    }

    public function schedule_settings()
    {
        return view('hospital.scheduleSettings.settings', [
            'setting' => ScheduleSetting::query()->where('hospital_id', Auth::user()->hospital_id)->first(),
        ]);
    }

    public function store_schedule_setting(Request $request)
    {
        $hospital_id = $request->hospital_id;
        ScheduleSetting::updateOrCreate([
           'hospital_id' => $hospital_id,
        ],[
            'time_interval' => $request->time_interval,
        ]);
        return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Interval time Updated']);
    }


    // Hospital patients
    public function hospital_patients(Hospital $hospital)
    {
        return view('admin.hospital.patient.index', [
            'patients' => User::query()
                ->join('appointments', 'users.id', '=', 'appointments.patient_id')
                ->where('appointments.hospital_id', $hospital->id)
                ->select('users.*')
                ->distinct()
                ->paginate('15'),
        ]);

    }
    public function doctor_patients(User $doctor)
    {
        return view('admin.doctor.patient.index', [
           'patients' => User::query()
               ->join('appointments', 'users.id', '=', 'appointments.patient_id')
               ->where('appointments.doctor_id', $doctor->id)
               ->select('users.*')
               ->distinct()
               ->paginate('15'),
        ]);
    }
}
