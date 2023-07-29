<?php

use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\HospitalDoctorsController;
use App\Http\Controllers\Admin\PatientControler;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SpecialityController;
use App\Http\Controllers\Admin\Settings\InvoiceController;
use App\Http\Controllers\Doctor\BlogController;
use App\Http\Controllers\Doctor\EducationController;
use App\Http\Controllers\Doctor\ExperienceController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Hospital\DoctorScheduleController;
// Hospital
use App\Http\Controllers\Hospital\ProfileController as HospitalProfile;
// Patient
use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\Patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\Patient\ReviewController;
use App\Http\Controllers\Patient\ProfileController as PatientProfile;
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'welcome']);
Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');

Route::get('/blog-list', function () {
    return view('patient.blog.index');
})->name('blog-list');

Route::get('/blog-details', function () {
    return view('patient.blog.show');
})->name('blog_details');

Route::get('/contact-us', function () {
    return view('contact-us');
})->name('contact-us');
Route::get('/optimize', [HomeController::class, 'optimize']);
Route::get('/migrate', [HomeController::class, 'migrate']);

Route::get('link-storage', function() {
    $targetFolder = storage_path('app/public');

    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';

    symlink($targetFolder, $linkFolder);

});



// Patient Routes
Route::get('search-doctor', [HomeController::class, 'search_doctor'])->name('search_doctor');
Route::get('search-doctor-index', [HomeController::class, 'search_doctor_index'])->name('search_doctor_index');
Route::get('search-pharmacy', [HomeController::class, 'search_pharmacy'])->name('search_pharmacy');
Route::get('doctors/{doctor}/profile', [HomeController::class, 'doctor_profile'])->name('doctor_profile');




Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Change Password
    Route::get('change-password', [CommonController::class, 'change_password'])->name('change_password');
    Route::post('store_new_password', [CommonController::class, 'store_new_password'])->name('store_new_password');

    // Admin Routes
    Route::resource('hospitalDoctors', HospitalDoctorsController::class);

    // Admin Profile
    Route::get("/admin-profile", [ProfileController::class, 'showProfile'])->name("admin.profile");
    Route::get("/admin-profile/edit", [ProfileController::class, 'editProfile'])->name("admin.profile.edit");
    Route::post("/admin-profile/update", [ProfileController::class, 'updateProfile'])->name("admin.profile.update");
    Route::get("/admin-password/edit", [ProfileController::class, 'editPassword'])->name("admin.password.edit");
    Route::post("/admin-password/update", [ProfileController::class, 'updatePassword'])->name("admin.password.update");

    // Reports
    Route::get('appointment-reports', [ReportController::class, 'appointment_reports'])->name('appointment_reports');
    Route::get('income-reports', [ReportController::class, 'income_reports'])->name('income_reports');
    Route::get('invoice-reports', [ReportController::class, 'invoice_reports'])->name('invoice_reports');
    Route::get('user_reports', [ReportController::class, 'user_reports'])->name('user_reports');


    Route::resource('speciality', SpecialityController::class);
    Route::post("/admin/hospital/{hospital}/password-update", [HospitalController::class, 'updatePassword'])->name("admin.hosptial.password.update");
    Route::resource('hospital', HospitalController::class);
    Route:: resource('doctor', DoctorController::class);
    Route::resource('patient', PatientControler::class);
    Route::post("/patient/{patient}/update-password", [PatientControler::class, 'updatePassword'])->name('admin.patient.update.password');
    Route::get('hospital-patients/{hospital}/list', [CommonController::class, 'hospital_patients'])->name('hospital_patients');
    Route::get('doctor-patients/{doctor}/list', [CommonController::class, 'doctor_patients'])->name('doctor_patients');
    Route::resource('profile', ProfileController::class);
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('save-settings', [SettingsController::class, 'store'])->name('store_settings');

    Route::get('schedule-settings', [CommonController::class, 'schedule_settings'])->name('schedule_settings');
    Route::post('store-schedule-settings', [CommonController::class, 'store_schedule_setting'])->name('store_schedule_settings');

    // Settings
    Route::get("invoice-settings", [InvoiceController::class, "edit"])->name("invoice-settings");
    Route::post("invoice-settings", [InvoiceController::class, "update"]);

    // Hospital routes
    Route::get("/hospital-profile", [HospitalProfile::class, "editProfile"])->name("hospital.edit.profile");
    Route::post("/hospital-profile", [HospitalProfile::class, "updateProfile"]);
    Route::get("/hospital-password/edit", [HospitalProfile::class, 'editPassword'])->name("hospital.password.edit");
    Route::post("/hospital-password/update", [HospitalProfile::class, 'updatePassword'])->name("hospital.password.update");
    // Doctor Schdule Routes
    // Repeat Schdule
    Route::get("/hospital/{doctor}/doctor-schedule", [DoctorScheduleController::class, "regularAvailabiltiyCreate"])->name("hospital.doctor-schedule.regular");
    Route::post("/hospital/{doctor}/doctor-schedule", [DoctorScheduleController::class, "regularAvailabiltiySave"]);
    Route::get("/hospital/{doctor}/doctor-schedule/edit", [DoctorScheduleController::class, "regularAvailabiltiyEdit"])->name("hospital.doctor-schedule.regular.edit");
    Route::post("/hospital/{doctor}/doctor-schedule/update", [DoctorScheduleController::class, "regularAvailabiltiyUpdate"])->name("hospital.doctor-schedule.regular.update");
    Route::post("/hospital/{doctor}/doctor-schedule/clear-all", [DoctorScheduleController::class, "regularAvailabiltiyDestroy"])->name("hospital.doctor-schedule.regular.destroy");

    // OneTime Schdule
    Route::get("/hospital/{doctor}/doctor-schedule/onetime", [DoctorScheduleController::class, "oneTimeAvailabiltiyCreate"])->name("hospital.doctor-schedule.onetime");
    Route::post("/hospital/{doctor}/doctor-schedule/onetime", [DoctorScheduleController::class, "oneTimeAvailabiltiySave"]);
    Route::get("/hospital/{doctor}/doctor-schedule/onetime/{date}/edit", [DoctorScheduleController::class, "oneTimeAvailabiltiyEdit"])->name("hospital.doctor-schedule.onetime.edit");
    Route::post("/hospital/{doctor}/doctor-schedule/onetime/{date}/update", [DoctorScheduleController::class, "oneTimeAvailabiltiyUpdate"])->name("hospital.doctor-schedule.onetime.update");
    Route::post("/hospital/{doctor}/doctor-schedule/onetime/{date}/delete", [DoctorScheduleController::class, "oneTimeAvailabiltiyDestroy"])->name("hospital.doctor-schedule.onetime.delete");

    // Unvailability Schdule
    Route::get("/hospital/{doctor}/doctor-schedule/unvailability", [DoctorScheduleController::class, "unAvailabiltiyCreate"])->name("hospital.doctor-schedule.unavailability");
    Route::post("/hospital/{doctor}/doctor-schedule/unvailability", [DoctorScheduleController::class, "unAvailabiltiySave"]);
    Route::get("/hospital/{doctor}/doctor-schedule/unvailability/{date}/edit", [DoctorScheduleController::class, "unAvailabiltiyEdit"])->name("hospital.doctor-schedule.unavailability.edit");
    Route::post("/hospital/{doctor}/doctor-schedule/unvailability/{date}/update", [DoctorScheduleController::class, "unAvailabiltiyUpdate"])->name("hospital.doctor-schedule.unavailability.update");
    Route::post("/hospital/{doctor}/doctor-schedule/unvailability/{date}/delete", [DoctorScheduleController::class, "unAvailabiltiyDestroy"])->name("hospital.doctor-schedule.unavailability.delete");


    //Doctor route
    Route::resource('education', EducationController::class);
    Route::resource('experience', ExperienceController::class);
    Route::resource('schedule', ScheduleController::class);
    //Blogs Route
    Route::get('blogs', [BlogController::class, 'index'])->name('blogs');
    Route::get('blogs/create-blog', [BlogController::class, 'create'])->name('create_blog');
    Route::post('store-blog', [BlogController::class, 'store'])->name('store_blog');
    Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('edit_blog');
    Route::patch('update-blog/{blog}/update', [BlogController::class, 'update'])->name('update_blog');
    Route::get('blogs/{blog}/details', [BlogController::class, 'show'])->name('show_blog');
    Route::delete('blogs/{blog}/blog', [BlogController::class, 'destroy'])->name('delete_blog');

    // doctor services
    Route::get('doctor-services', [CommonController::class, 'doctor_services'])->name('doctor_services');
    Route::post('add-doctor-services', [CommonController::class, 'store_services'])->name('store_services');
    // doctor specializations
    Route::get('doctor-specialization', [CommonController::class, 'doctor_specializations'])->name('doctor_specialization');
    Route::post('add-doctor-specialization', [CommonController::class, 'store_specialization'])->name('store_specializations');
    // Clinic Details
    Route::get('add-new-clinic', [CommonController::class, 'clinic_details'])->name('doctor_clinic');
    Route::post('store-new-clinic', [CommonController::class, 'store_clinic'])->name('store_clinic');

    // Review
    Route::post('add-review', [ReviewController::class, 'store'])->name('add_review');
    Route::get('reviews', [ReviewController::class, 'index'])->name('reviews');

    // Patient Appointments
    Route::get('appointment/{doctor}/create', [AppointmentController::class, 'create_appointment'])->name('create_appointment');
    Route::post('store-appointment', [AppointmentController::class, 'store_appointment'])->name('store_appointment');
    Route::get('appointments', [AppointmentController::class, 'manage_appointments'])->name('appointments');
    Route::patch('appointments/{appointment}/update', [AppointmentController::class, 'update_apt_status'] )->name('update_appointment_status');
    Route::get('appointment/{doctor}/availability', [AppointmentController::class, 'get_availability'])->name('get_availability');

    // Patient Profile
    Route::get("/patient-profile", [PatientProfile::class, 'showProfile'])->name("patient.profile");
    Route::get("/patient-profile/edit", [PatientProfile::class, 'editProfile'])->name("patient.profile.edit");
    Route::post("/patient-profile/update", [PatientProfile::class, 'updateProfile'])->name("patient.profile.update");
    Route::get("/patient-password/edit", [PatientProfile::class, 'editPassword'])->name("patient.password.edit");
    Route::post("/patient-password/update", [PatientProfile::class, 'updatePassword'])->name("patient.password.update");

    // Invoice Routes
    Route::get('invoices', [AppointmentController::class, 'invoice'])->name('invoices');
    Route::get('invoices/{invoice}/view', [AppointmentController::class, 'show_invoice'])->name('show_invoice');

    // Mark payment as paid
    Route::post("/invoices/{invoice}/change-payment-status", [AppointmentController::class, "changePaymentStatus"])
        ->name("invoice.change.payment.status")->can("changePaymentStatus", "invoice");
    // Patient Dashboard
    Route::get('patient-dashboard', [PatientDashboardController::class, "index"])->name('patient_dashboard');

    //LAng


});
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
require __DIR__ . '/auth.php';
