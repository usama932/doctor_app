<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpecialityController extends Controller
{
    protected  $image_path = 'public/images/';
    public function index()
    {
        return view('admin.speciality.index', [
            'specialities' => Speciality::query()->orderByDesc('id')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.speciality.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
           'name' => 'required',
           'image' => 'required|image'
        ]);
        if ($file = $request->file('image'))
        {
            $filename = time() . '-'. $file->getClientOriginalName();
            Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
        }
        $attributes['image'] = $filename;

        Speciality::create($attributes);
        return redirect()
            ->route('speciality.index')
            ->with('flash', ['type', 'success', 'message' => 'Speciality added Successfully']);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        return view('admin.speciality.edit',
        [
           'speciality' => Speciality::find($id),
        ]);
    }


    public function update(Request $request, $id)
    {
        if ($speciality = Speciality::find($id))
        {
            $attributes = $request->validate([
               'name' => 'required',
               'image' => 'image'
            ]);

            if ($attributes['image'] ?? false)
            {
                if ($file = $request->file('image'))
                {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    Storage::disk('local')->put($this->image_path . $filename, $file->getContent());
                }
                $attributes['image'] = $filename;
            }
            $speciality->update($attributes);

            return redirect()
                ->route('speciality.index')
                ->with('flash', ['type', 'success', 'message' => 'Speciality Updated Successfuly']);
        }
    }

    public function destroy($id)
    {
        $speciality = Speciality::find($id);
        $speciality->delete();

        return redirect()
            ->route('speciality.index')
            ->with('flash', ['type', 'success', 'message' => 'Speciality deleted Successfully']);
    }
}
