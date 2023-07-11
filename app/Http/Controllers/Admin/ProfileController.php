<?php

namespace App\Http\Controllers\Admin;

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
    protected  $image_path = 'public/images/admin/';
    public function index()
    {
        if(Auth::user()->is_hospital())
        {
            return view('hospital.profile.index',[
                'hospital' => Hospital::query()->where('id', Auth::user()->hospital_id)->get(),
                'hospital_admin' => User::find(Auth::id()),
            ]);

        }
        elseif (Auth::user()->is_doctor())
        {
            return view('doctor.profile.index', [
               'doctor' =>User::find(Auth::id()),
                'edu_details' => Education::query()->where('user_id', Auth::id())->orderByDesc('id')->get(),
                'experiences' => Experience::query()->where('user_id', Auth::id())->orderByDesc('id')->get(),
            ]);
        }
        elseif (Auth::user()->is_patient())
        {
            return view('patient.profile.index', [
               'patient' => User::find(Auth::id()),
            ]);
        }

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        if (Auth::user()->is_hospital())
        {
            return view('hospital.profile.edit',[
               'hospital_admin' => User::find($id),
            ]);
        }
        elseif (Auth::user()->is_doctor())
        {
            return view('doctor.profile.edit',[
               'doctor' => User::find($id),
            ]);
        }
        elseif (Auth::user()->is_patient())
        {
            return view('patient.profile.edit', [
               'patient' => User::find($id)
            ]);
        }
    }

    public function update(Request $request, $id)
    {

                $attributes = $request->validate([
                    'name' => 'required',
                    'email' => 'required',
                    'username' => 'nullable',
                    'profile_image' => 'image',
                    'mobile' => 'required',
                    'description' => 'required',
                    'date_of_birth' => 'required',
                    'gender' => 'required',
                    'age' => 'required',
                    'address' => 'required',
                    'country' => 'required',
                    'state' => 'required',
                    'zip_code' => 'required',
                    'blood_group' => 'nullable',
                    'pricing' => 'nullable',
                    'twitter' => 'nullable',
                    'facebook' => 'nullable',
                    'linkedin' => 'nullable',
                    'pinterest' => 'nullable',
                    'instagram' => 'nullable',
                    'youtube'=> 'nullable',
                ]);
                if ($attributes['profile_image'] ?? false)
                {
                    if ($file = $request->file('profile_image'))
                    {
                        $filename = time() . '-'. $file->getClientOriginalName();
                        Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
                    }
                     $attributes['profile_image'] = $filename;
                }
                Auth::user()->update($attributes);

            return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Profile Updated Successfully']);
    }

    public function destroy($id)
    {}

    public function showProfile(){
        return view('admin.profile.index',[
            'admin' => Auth::user(),
        ]);
    }
    public function editProfile(){
        return view('admin.profile.edit', [
            'admin' => Auth::user(),
        ]);
    }
    public function updateProfile(Request $request){
        $user = Auth::user();
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => [
                'required', Rule::unique('users', 'email')->ignore($user->id)
            ],
            'username' => ['nullable'],
            'mobile' => ['nullable'],
            'date_of_birth' => ['required'],
            'gender' => ['required'],
            'profile_image' => ['image'],
            'address' => ['nullable'],
            'country' => ['required'],
            'state' => ['required'],
            'zip_code' => ['required'],
            'description' => ['nullable'],
        ]);

        if ($request->hasFile('profile_image')){
            $file = $request->file('profile_image');
            $filename = $user->profile_image ?? time() . '-'. $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
            $attributes['profile_image'] = $filename;
        }
        // dd($user);
        Auth::user()->update($attributes);

    return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Profile Updated Successfully']);
    }
    public function editPassword(){
        return view('admin.profile.change-password');
    }
    public function updatePassword(Request $request){
        $request->validate([
            'password' => ['required','confirmed'],
            'password_confirmation' => ['required'],
        ]);
        // dd($request->all());

        auth()->user()->update(['password' => \Hash::make($request->password)]);

        return redirect()
            ->back()
            ->with('flash', ['type', 'success', 'message' => 'Password Changed Successfully']);
    }
}
