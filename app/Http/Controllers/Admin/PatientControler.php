<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PatientControler extends Controller
{
    protected $image_path = 'public/images/patients/';

    public function index()
    {
        if (Auth::user()->is_admin()) {
            $patients = User::query()->where('user_type', 'U')->orderByDesc('id')->get();
            return view('admin.patient.index', [
                'patients' => $patients,
            ]);
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.patient.index', [
                'patients' => User::query()
                    ->join('appointments', 'users.id', '=', 'appointments.patient_id')
                    ->where('appointments.hospital_id', Auth::user()->hospital_id)
                    ->select('users.*')
                    ->distinct()
                    ->paginate('15'),
            ]);
        } elseif (Auth::user()->is_doctor()) {
            return view('doctor.patient.index', [
                'patients' => User::query()
                    ->join('appointments', 'users.id', '=', 'appointments.patient_id')
                    ->where('appointments.doctor_id', Auth::id())
                    ->select('users.*')
                    ->distinct()
                    ->paginate('15'),
            ]);
        }
    }

    public function create()
    {
        if (Auth::user()->is_admin()) {
            return view('admin.patient.create');
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.patient.create');
        }

    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => [
                'required', "unique:users,email"
            ],

            'profile_image' => ['image'],
            'mobile' => [
                'required', 'required', "unique:users,mobile"
            ],
            'date_of_birth' => ['required'],
            'gender' => ['required', "in:M,F,O"],
            'blood_group' => ['nullable', "in:A+,A-,B+,B-,O+,O-,AB+,AB-"],
            'user_type' => ['required'],
            "password" => ["required"],
        ]);
        // dd($request->all());

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '-' . $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
            $attributes['profile_image'] = $filename;
        }
        $attributes["password"] = \Hash::make($request->password);
        User::create($attributes);

        return redirect()
            ->back()
            ->with('flash', ['type', 'success', 'message' => 'Patient Added Successfully.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        if (Auth::user()->is_admin()) {
            return view('admin.patient.edit', [
                'patient' => User::find($id),
                'hospitals' => Hospital::query()->orderByDesc('id')->get(),
            ]);
        } elseif (Auth::user()->is_hospital()) {
            return view('hospital.patient.edit', [
                'patient' => User::find($id),
            ]);
        }

    }

    public function update(Request $request, $id)
    {

        $patient = User::findOrFail($id);
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => [
                'required', Rule::unique('users', 'email')->ignore($patient->id),
            ],

            'profile_image' => ['image'],
            'mobile' => [
                'required', 'required', Rule::unique('users', 'mobile')->ignore($patient->id)
            ],
            'date_of_birth' => ['required'],
            'gender' => ['required', "in:M,F,O"],
            'blood_group' => ['nullable', "in:A+,A-,B+,B-,O+,O-,AB+,AB-"],
            'user_type' => ['required'],
            'status' => ['required', "in:Active,Inactive"],
        ]);
        if ($request->hasFile('profile_image'))
        {
            $file = $request->file('profile_image');
            $filename = $user->profile_image ?? time() . '-'. $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
            $attributes['profile_image'] = $filename;
        }
        $patient->update($attributes);

        return redirect()
            ->back()
            ->with('flash', ['type', 'success', 'message' => 'Patient Updated Successfully.']);
    }

    public function destroy($id)
    {
        $patient = User::find($id);
        $patient->delete();

        return redirect()
            ->route('patient.index')
            ->with('flash', ['type', 'success', 'message' => 'Patient Deleted Successfuly']);
    }

    public function updatePassword(Request $request, User $patient)
    {
        $request->validate([
            'password' => ['required','confirmed'],
            'password_confirmation' => ['required'],
        ]);

         $patient->update(['password' => \Hash::make($request->password)]);

         return redirect()
             ->back()
             ->with('flash', ['type', 'success', 'message' => 'Password Changed Successfully']);
    }
}
