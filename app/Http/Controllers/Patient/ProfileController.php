<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    protected $image_path = 'public/images/patients/';

    public function showProfile()
    {
        return view('patient.profile.index', [
           'patient' => Auth::user(),
        ]);
    }


    public function editProfile()
    {
        $patient = Auth::user();

        return view('patient.profile.edit', [
           'patient' => $patient
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => [
                'required', Rule::unique('users', 'email')->ignore($user->id)
            ],
            'username' => [
                'required', 'required', Rule::unique('users', 'username')->ignore($user->id)
            ],
            'profile_image' => ['image'],
            'mobile' => [
                'required', 'required', Rule::unique('users', 'mobile')->ignore($user->id)
            ],
            'date_of_birth' => ['required'],
            'gender' => ['required', "in:M,F,O"],
            'address' => ['nullable'],
            'country' => ['nullable'],
            'state' => ['nullable'],
            'zip_code' => ['nullable'],
            'blood_group' => ['nullable', "in:A+,A-,B+,B-,O+,O-,AB+,AB-"],
        ]);

        if ($request->hasFile('profile_image'))
        {
            $file = $request->file('profile_image');
            $filename = $user->profile_image ?? time() . '-'. $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
            $attributes['profile_image'] = $filename;
        }
        $user->update($attributes);

        return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Profile Updated Successfully']);
    }

    public function editPassword()
    {
        return view('patient.profile.change-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
             'new_password' => ['required','confirmed'],
             'new_password_confirmation' => ['required'],
         ]);

         auth()->user()->update(['password' => \Hash::make($request->new_password)]);

         return redirect()
             ->back()
             ->with('flash', ['type', 'success', 'message' => 'Password Changed Successfully']);
    }
}
