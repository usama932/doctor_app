<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GenralSettings;

class InvoiceController extends Controller
{
    public function edit(){
        $invoiceSettings = GenralSettings::where('parent', 'invoice')->get();
        $invoiceSettings = GenralSettings::makeFlat($invoiceSettings);
        return view("admin.settings.invoice", ["invoiceSettings" => $invoiceSettings]);
    }
    public function update(Request $request){
        $request->validate([
            "vat" => ["required", "numeric"],
            "footer_text" => ["nullable"]
        ]);
        foreach($request->except("_token") as $key => $value){
            GenralSettings::updateOrCreate(["key" => $key],[
                "key" => $key,
                "value" => $value,
                "parent" => "invoice"
            ]);
        }

        return redirect()->back()->with("success", "Settings has been updated");
    }
}
