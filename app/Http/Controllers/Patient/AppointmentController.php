<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\ScheduleSetting;
use App\Models\User;
use App\Models\Doctor;
use App\Models\GenralSettings;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function create_appointment($id)
    {
        $doctor = User::find($id);
        $time_interval = ScheduleSetting::query()->where('hospital_id', $doctor->hospital_id)->first();
        for ($i = 0; $i <= 6; $i++) {
            if ($doctor->schedules[$i]->from ?? '') {
                $starting_time = $doctor->schedules[$i]->from;
                $end_time = $doctor->schedules[$i]->to;
                if ($time_interval->time_interval ?? '') {
                    $intervals = CarbonInterval::minutes($time_interval->time_interval)->toPeriod($starting_time, $end_time);
                } else {
                    $intervals = CarbonInterval::minutes(60)->toPeriod($starting_time, $end_time);
                }
            }
        }
        if ($intervals ?? '')
        return view('patient.appointment.create', [
            'doctor' => User::find($id),
            'intervals' => $intervals,
            'date' => today(),
        ]);
        else
            return view('patient.appointment.create', [
                'doctor' => User::find($id),
                'date' => today(),
            ]);
    }

    public function store_appointment(Request $request)
    {
        $attributes = $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'hospital_id' => 'required',
            // "schedule_date" => ['required', "date"],
            // 'appointment_date' => 'required',
            // 'appointment_time' => 'required',
            "selected_slot" => "required",
            'status' => 'required'
        ],[
            "selected_slot.required" => "Please select a time slot",
        ]);
        // dd($request->all());
        $doctor = User::where('id', $request->doctor_id)->first();
        $dateTime = CarbonImmutable::parse($request->selected_slot);
        // VAT
        $invoiceSettings = GenralSettings::where('parent', 'invoice')->get();
        $invoiceSettings = GenralSettings::makeFlat($invoiceSettings);
        $request->merge([
            "appointment_date" => $dateTime->format("Y-m-d"),
            "appointment_time" => $dateTime->format("H:i:s"),
            "fee" => $doctor->pricing,
            "vat" => $invoiceSettings->get("vat", 0.0),
        ]);
        Appointment::create($request->except("selected_slot"));

        return redirect()
            ->route('appointments')
            ->with('flash', ['type', 'success', 'message' => 'Appointment create Successfully']);
    }
    public function manage_appointments()
    {
        $appointments = Appointment::query()
            ->with(['hospital', 'doctor', "patient"])
            ->orderBy('appointment_date', "ASC")
            ->orderBy('appointment_time', "ASC");

        if (Auth::user()->is_patient())
        {
            $appointments->where('patient_id', Auth::id());
            return view('patient.appointment.index', [
                'appointments' => $appointments->get(),
            ]);
        }
        if (Auth::user()->is_doctor())
        {
            $appointments->where('doctor_id', Auth::id());
            return view('doctor.appointment.index',[
                'appointments' => $appointments->get(),
            ]);
        }
        if (Auth::user()->is_hospital())
        {
            $appointments->where('hospital_id', Auth::user()->hospital_id);
            return view('hospital.appointment.index', [
               'appointments' => $appointments->get(),
            ]);
        }
        if (Auth::user()->is_admin())
        {
            return view('admin.appointment.index', [
                'appointments' => $appointments->paginate('10'),
            ]);
        }
    }

    public function update_apt_status(Appointment $appointment)
    {
        if ($appointment = $appointment)
        {
            $attributes = request()->validate([
               'status' => 'required',
            ]);
            $appointment->update($attributes);
        }
        if (request('status') == 'C')
        {
            return redirect()
                ->route('appointments')
                ->with('flash', ['type', 'success', 'message' => 'Appointment Confirmed']);
        }
        elseif (request('status') == 'D')
        {
            return redirect()
                ->route('appointments')
                ->with('flash', ['type', 'fail', 'message' => 'Appointment Cancelled']);
        }elseif(request('status') == 'P')
        {
            return redirect()
                ->route('appointments')
                ->with('flash', ['type', 'fail', 'message' => 'Appointment Booked again wait for the confirmation']);
        }
    }

    public function invoice()
    {

        if (Auth::user()->is_doctor())
        {
            $invoices = Appointment::query()
                ->where('doctor_id', Auth::id())
                ->with(['hospital', 'patient'])
                ->orderBy('appointment_date', "DESC")
                ->orderBy('appointment_time', "DESC")
                ->get();
            return view('doctor.invoice.index', [
                'invoices' => $invoices,
            ]);
        }
        elseif (Auth::user()->is_hospital())
        {
            $invoices = Appointment::query()
            ->where('hospital_id', Auth::user()->hospital_id)
            ->with(['patient', 'doctor'])
            ->orderBy('appointment_date', "DESC")
            ->orderBy('appointment_time', "DESC")
            ->get();
            return view('hospital.invoice.index', [
                'invoices' => $invoices,
            ]);
        }
        elseif (Auth::user()->is_patient())
        {
            $invoices = Appointment::query()
            ->where('patient_id', Auth::user()->id)
            ->with(['hospital', 'doctor'])
            ->orderBy('appointment_date', "DESC")
            ->orderBy('appointment_time', "DESC")
            ->get();
            return view('patient.invoice.index', [
                'invoices' => $invoices,
            ]);
        }
        elseif (Auth::user()->is_admin())
        {
            $invoices = Appointment::query()
            ->with(['hospital', 'doctor', "patient"])
            ->orderBy('appointment_date', "DESC")
            ->orderBy('appointment_time', "DESC")
            ->get();
            return view('admin.invoice.index',
            [
                'invoices' => Appointment::query()->orderByDesc('id')->get(),
            ]);
        }
    }

    public function show_invoice(Appointment $invoice)
    {
        $invoiceSettings = GenralSettings::where('parent', 'invoice')->get();
        $invoiceSettings = GenralSettings::makeFlat($invoiceSettings);
        $invoice->load(['doctor', 'patient', 'hospital']);
        if (Auth::user()->is_doctor())
        {
            return view('doctor.invoice.show', [
                'invoice' => $invoice,
                'invoiceSettings' => $invoiceSettings,
            ]);
        }elseif (Auth::user()->is_hospital())
        {
            return view('hospital.invoice.show', [
                'invoice' => $invoice,
                'invoiceSettings' => $invoiceSettings,
            ]);
        }
        elseif (Auth::user()->is_patient())
        {
            return view('patient.invoice.show', [
                'invoice' => $invoice,
                'invoiceSettings' => $invoiceSettings,
            ]);
        }
        elseif (Auth::user()->is_admin())
        {
            return view('admin.invoice.show', [
                'invoice' => $invoice,
                'invoiceSettings' => $invoiceSettings,
            ]);
        }

    }

    /*
    * Create Availability Slots of a doctor
    * @Param $id (DoctorId)
    * @RequesData: startDate(To generate week calander)
    * @return slots of 7 days
    */
    public function get_availability(Request $request, $id){
        $doctor = User::find($id);
        $doctor->load("regularAvailabilities", "oneTimeailabilities", "unavailailities");

        // dd($request->selectedDate);
        $time_interval = 15;
        // Create selected CarbonDate instance
        $selectedDate = CarbonImmutable::parse($request->selectedDate);
        // create date
        $date = $selectedDate->format("Y-m-d");
        // day of the week
        $day_name = strtolower($selectedDate->format("l"));

        // Doctor set unavailabilty on a specific date
        $unavailability = $doctor->unavailailities()->where("date", $date)->first();
        // return Not available
        if($unavailability){
            return response()->json([
                "status" => "error",
                "message" => "Not Available",
                "data" => [],
            ]);
        }

        // Check if doctor set One time appointment on a specific date
        $availability = null;
        $oneTimeAvailability = $doctor->oneTimeailabilities()->where("date", $date)->first();
        if($oneTimeAvailability){
            // Get time intervals to create slots
            $time_interval = $oneTimeAvailability->time_interval ? $oneTimeAvailability->time_interval : 15;
            $availability = $oneTimeAvailability;
        }else{
            $regularAvailability = $doctor->regularAvailabilities()->where("week_day", $day_name)->first();
            if($regularAvailability){
                // Get time intervals to create slots
                $time_interval = $regularAvailability->time_interval ? $regularAvailability->time_interval : 15;
                $availability = $regularAvailability;
            }
        }

        // if availability is null
        if(!$availability){
            return response()->json([
                "status" => "error",
                "message" => "Not Available",
                "data" => [],
            ]);
        }
        // Appointments of selected date
        $appointments = Appointment::where('appointment_date', $date)
        ->where('doctor_id', $doctor->id)->pluck("appointment_time");

        // Creating Slots
        $slots = [];
        $filteredSlots = collect([]);
        $intervals = collect($availability->slots)->sortBy('start_time');
        // Fliter slots
        foreach ($intervals as  $interval) {
            $start_dt = $date . $interval["start_time"];
            $end_dt = $date . $interval["end_time"];
            // Create Slots
            $slots = CarbonPeriod::create($start_dt, $time_interval.' minutes', $end_dt);
            foreach ($slots as $slot) {
                if($slot->greaterThan(Carbon::now()->addMinutes(20))){
                    if(!$appointments->contains($slot->format("H:i:s"))){
                        $filteredSlots->push($slot->format("Y-m-d H:i"));
                    }
                }
            }
        }
        return response()->json([
            "status" => "success",
            "message" => "ok",
            "data" => $filteredSlots->unique()->values()->slice(0, -1)->all()
        ]);
    }

    /*
    * Create Availability Slots of a doctor
    * @Param $id (DoctorId)
    * @RequesData: startDate(To generate week calander)
    * @return slots of 7 days
    */
    public function get_availabilityOLD(Request $request, $id){
        $doctor = User::find($id);
        $doctor->load('schedules');

        // Create startDate instance
        $start_date = CarbonImmutable::parse($request->startDate);

        // time interval for creating slots
        $time_interval = ScheduleSetting::query()->where('hospital_id', $doctor->hospital_id)->first();
        $time_interval = $time_interval ? $time_interval->time_interval : 15;
        //Get list of days from today
        $days = [];

        // Loop through days of week (starting from today e.x: Thursday (0))
        for ($i = 0; $i < 7; $i++) {
            // Create temp day for calculation
            $temp_day = $start_date->addDays($i);
            // return fullname of the day
            $temp_day_name = $temp_day->englishDayOfWeek;

            // Get doctor schedule of the current looping day
            $schedule_data = $doctor->schedules->filter(function($val, $idx) use ($temp_day_name){
                return $val->day == $temp_day_name;
            })->first();

            $today_appointments = Appointment::where('appointment_date', $temp_day->format("Y-m-d"))
            ->where('doctor_id', $doctor->id)->pluck("appointment_time");

            // dd($today_appointments, $temp_day->format("Y-m-d"));

            // Creating Slots
            $slots = [];
            // hold slots of the day
            $days[$temp_day_name] = collect([]);

            if($schedule_data){
                $start_dt = $temp_day->format("Y-m-d") . $schedule_data->from;
                $end_dt = $temp_day->format("Y-m-d") . $schedule_data->to;
                // Create Slots
                $slots = CarbonPeriod::create($start_dt, $time_interval.' minutes', $end_dt);

                // pushing slots to days
                foreach ($slots as $slot) {
                    if($slot->greaterThan(Carbon::now()->addMinutes(20))){
                        if(!$today_appointments->contains($slot->format("H:i:s"))){
                            $days[$temp_day_name]->push($slot->format("H:i:s"));
                        }
                    }
                }
            }
        }
        return response()->json([
            "status" => "ok",
            "data" => array_values($days)
        ]);
    }

    /*
    * Change invoice status
    */
    public function changePaymentStatus(Request $request, Appointment $invoice){
        $payment_stautus = "Unpaid";
        $payment_date = null;
        if($invoice->payment_status == "Unpaid"){
            $payment_stautus = "Paid";
            $payment_date = now();
        }

        $invoice->update([
            "payment_status" => $payment_stautus,
            "payment_date" => $payment_date,
        ]);

        return redirect()->back()->with('flash', ['type', 'success', 'message' => 'Payment has been marked as '.$payment_stautus]);
    }
}
