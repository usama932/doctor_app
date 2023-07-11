<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Speciality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HospitalController extends Controller
{
    protected  $image_path = 'public/images/hospitals/';

    public function index()
    {
        return view('admin.hospital.index', [
            'hospitals' => Hospital::query()->with("adminUser")->orderByDesc('id')->get(),
        ]);
    }
    public function create()
    {
        return view('admin.hospital.create');
    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'hospital_name' => 'required',
            'image' => 'required|image',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',

        ]);

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '-'. $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
            $attributes['image'] = $filename;
        }

        $hospital = Hospital::create($attributes);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => User::HOSPITAL,
            'hospital_id' => $hospital->id,
            "profile_image" => $hospital->image,
        ]);

        return redirect()
            ->route('hospital.index')
            ->with('flash', ['type', 'success', 'message' => 'Hospital and Admin created Successfully']);
    }


    public function show($id)
    {
        $hospital = Hospital::find($id);
        return view('admin.hospital.doctor.index',
        [
           'doctors' => User::query()->where('user_type', 'D')->where('hospital_id', $hospital->id)->orderByDesc('id')->get(),
        ]);
    }


    public function edit($id)
    {
        return view('admin.hospital.edit', [
            'hospital' => Hospital::find($id),
            'admin' => User::query()->where('hospital_id', $id)->where('user_type', 'H')->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($hospital = Hospital::find($id))
        {
            $attributes = $request->validate([
                'hospital_name' => 'required',
                'image' => 'image',
                'address' => 'required',
                'country' => 'required',
                'state' => 'required',
                'city' => 'required',
                'zip' => 'required',
            ]);
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $filename = time() . '-'. $file->getClientOriginalName();
                Storage::disk('local')->put($this->image_path . $filename , $file->getContent());
                $attributes['image'] = $filename;
            }

            $hospital->update($attributes);
            if ($admin = User::query()->where('hospital_id', $id)->where('user_type', 'H')->first())
            $admin->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                "profile_image" => $hospital->image,
            ]);

                return redirect()
                    ->route('hospital.index')
                    ->with('flash', ['type', 'success', 'message' => 'Hospital Details updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hospital = Hospital::find($id);
        $hospital->delete();

        return redirect()
            ->route('hospital.index');
    }

    public function updatePassword(Request $request, Hospital $hospital){
        $request->validate([
            'password' => ['required','confirmed'],
            'password_confirmation' => ['required'],
        ]);

        // dd($hospital->adminUser, $request->all(), \Hash::make($request->password));
        $hospital->adminUser()->update(['password' => \Hash::make($request->password)]);

        return redirect()
            ->back()
            ->with('flash', ['type', 'success', 'message' => 'Password Changed Successfully']);
    }
}
