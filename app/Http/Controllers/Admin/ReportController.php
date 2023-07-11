<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function appointment_reports()
    {
        return view('admin.reports.appointment_reports', [
            'appointments' => Appointment::query()->orderByDesc('id')->get(),
        ]);
    }
    public function income_reports()
    {
        return view('admin.reports.income_reports', [
            'doctors' => User::query()->where('user_type', 'D')->get(),
        ]);
    }

    public function invoice_reports()
    {
        return view('admin.reports.invoice_reports', [
            'invoices' => Appointment::query()->orderByDesc('id')->get(),
        ]);
    }

    public function user_reports()
    {
        return view('admin.reports.user_reports',
        [
            'patients' => User::query()->where('user_type', 'U')->get(),
        ]);
    }
}
