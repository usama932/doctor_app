<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user->load("appointments", "appointments.doctor.speciality");
        $appontments = $user->appointments;
        $upCommingAppointments = $appontments->where("appointment_date", ">=", date("Y-m-d"));
        $confirmedAppointments = $appontments->where("status", "C")
                                        ->where("payment_status", "Paid")
                                        ->where("payment_date", "!=", null);
        $totalSpent = $confirmedAppointments->sum(function($appointment){
            $vat = ($appointment->fee*$appointment->vat) / 100;
            return ($appointment->fee+$vat) - $appointment->discount;
        });
        return view('patient.patient-dashboard', [
            "appointments" => $appontments,
            "upcommingAppointments" => $upCommingAppointments,
            "confirmedAppointments" => $confirmedAppointments,
            "totalSpent" => $totalSpent,
        ]);
    }
}
