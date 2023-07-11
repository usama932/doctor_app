@extends('layout.mainlayout_admin')
@section('title', 'Appointment Reports')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif

            <!-- Appointments Report -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Appointment Report</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="bookingrange btn btn-white btn-sm">
                                        <div class="cal-ico">
                                            <i class="feather-calendar me-1"></i>
                                            <span>Select Date</span>
                                        </div>
                                        <div class="ico">
                                            <i class="fas fa-chevron-left"></i>
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="sales_chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Appointments Report -->

            <!-- Upcoming Appointments -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="app-listing">
                        <div class="import-list">
                            <a href="#"><i class="feather-download"></i> Import</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-tables">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Disease</th>
                                        <th>Consultation type</th>
                                        <th>Date & Time</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($appointments as $appointment)
                                        @php
                                        $patient = \App\Models\User::query()->where('id', $appointment->patient_id)->first();
                                        $doctor = \App\Models\User::query()->where('id', $appointment->doctor_id)->first();
                                        @endphp
                                    <tr>

                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="#"><img class="avatar avatar-img" src="{{ asset_img('patients', $patient->profile_image) }}"></a>
                                                <a href="#"><span class="user-name">{{ $patient->name }}s</span> <span class="text-muted">Male, {{ $patient->age }} Years Old</span></a>
                                            </h2>
                                        </td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a class="avatar-pos" href="#"><img class="avatar avatar-img" src="{{ asset_img('doctors', $doctor->profile_image) }}"></a>
                                                <a href="{{url('admin/profile')}}" class="user-name"><span class="text-muted">Dr. {{ $doctor->name }}</span> <span class="tab-subtext">{{ $doctor->speciality->name }}</span></a>
                                            </h2>
                                        </td>
                                        <td><span class="disease-name">Allergies & Asthma</span></td>
                                        <td class="status">
                                            <span>Scheduled Appointment</span>
                                            <a href="#" class="d-block text-primary mt-2">
                                                <span class="d-flex align-items-center"><i class="feather-video me-2"></i> Video call</span>
                                            </a>
                                        </td>
                                        <td><span class="user-name">{{ $appointment->appointment_date }} </span><span class="d-block">{{ $appointment->appointment_time }}</span></td>
                                        @if($doctor->pricing == 'Free')
                                        <td>Free</td>
                                        @else
                                            <td>${{ $doctor->pricing }}</td>
                                        @endif
                                    </tr>
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

    // Pop up module
    {{--    <!-- Add Event Modal -->--}}
    {{--    <div class="modal custom-modal fade none-border" id="delete_review">--}}
    {{--        <div class="modal-dialog modal-dialog-centered">--}}
    {{--            <div class="modal-content">--}}
    {{--                <div class="modal-header">--}}
    {{--                    <h4 class="modal-title">Delete {{ $review->review_title }}</h4>--}}
    {{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">&times;</button>--}}
    {{--                </div>--}}
    {{--                <div class="modal-body"></div>--}}
    {{--                <div class="modal-footer justify-content-center">--}}
    {{--                    <button type="button" class="btn btn-danger delete-event submit-btn" data-bs-dismiss="modal">Delete</button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- /Add Event Modal -->

@endsection
