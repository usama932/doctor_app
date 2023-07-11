<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    protected  $image_path = 'public/images/';
    public function index()
    {
        return view('admin.settings.index', [
            'setting' => Settings::first(),
        ]);
    }

    public function store(Settings $settings,Request $request)
    {
        if ($settings = Settings::first())
        {
            $attributes = $request->validate([
                'website_name' => 'nullable',
                'phone' => 'nullable',
                'email' => 'nullable',
                'logo' => 'nullable',
                'favicon' => 'nullable',
                'address_line_1' => 'nullable',
                'address_line_2' => 'nullable',
                'city' => 'nullable',
                'state' => 'nullable',
                'zip_code' => 'nullable',
                'country' => 'nullable',
                'facebook' => 'nullable',
                'twitter' => 'nullable',
                'youtube' => 'nullable',
                'linkedin' => 'nullable',
            ]);
            if ($attributes['logo'] ?? false)
            {
                if ($file = $request->file('logo'))
                {
                    $logo = time() . '-' . $file->getClientOriginalName();
                    Storage::disk('local')->put($this->image_path . $logo , $file->getContent());
                }
                $attributes['logo'] = $logo;
            }
            if ($attributes['favicon'] ?? false)
            {
                if ($file = $request->file('favicon'))
                {
                    $favicon = time() . '-' . $file->getClientOriginalName();
                    Storage::disk('local')->put($this->image_path . $favicon, $file->getContent());
                }
                $attributes['favicon'] = $favicon;
            }
            $settings->update($attributes);
        }
        return redirect()->back();
    }
}
