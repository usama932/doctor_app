<?php $page = "doctor-dashboard"; ?>
@extends('layout.mainlayout_hospital')
@section('title', 'Hospital Dashboard')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">

        <div class="row">
            <div class="col-md-12">
                <div class="card dash-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-3">
                                <a href="{{ route('doctor.index') }}" class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar1">
                                        <div class="circle-graph1" data-percent="100">
                                            <img src="{{ URL::asset('/assets/img/icon-01.png')}}" class="img-fluid"
                                                 alt="patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Doctors</h6>
                                        <h3>{{ $doctorCount }}</h3>
                                        <p class="text-muted"></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-12 col-lg-3">
                                <a href="{{ route('patient.index') }}" class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar2">
                                        <div class="circle-graph2" data-percent="100">
                                            <img src="{{ URL::asset('/assets/img/icon-02.png')}}" class="img-fluid"
                                                 alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Total Patient</h6>
                                        <h3>{{ $patientCount }}</h3>
                                        <p class="text-muted"></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-12 col-lg-3">
                                <a href="{{ route('appointments') }}">
                                <div class="dash-widget dct-border-rht">
                                    <div class="circle-bar circle-bar3">
                                        <div class="circle-graph3" data-percent="50">
                                            <img src="{{ URL::asset('/assets/img/icon-03.png')}}" class="img-fluid"
                                                 alt="Patient">
                                        </div>
                                    </div>
                                    <div class="dash-widget-info">
                                        <h6>Today Appoinments</h6>
                                        <h3>{{ $todayAppointments->total() }}</h3>

                                    </div>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-12 col-lg-3">
                                <a href="{{ route('appointments') }}">
                                    <div class="dash-widget">
                                        <div class="circle-bar circle-bar3">
                                            <div class="circle-graph3" data-percent="50">
                                                <img src="{{ URL::asset('/assets/img/icon-03.png')}}" class="img-fluid"
                                                     alt="Patient">
                                            </div>
                                        </div>
                                        <div class="dash-widget-info">
                                            <h6>Appoinments</h6>
                                            <h3>{{ $appointmentCount }}</h3>

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Patient Appoinment</h4>
                <div class="appointment-tab">

                    <!-- Appointment Tab -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{url('#upcoming-appointments')}}" data-bs-toggle="tab">Upcoming</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('#today-appointments')}}" data-bs-toggle="tab">Today</a>
                        </li>
                    </ul>
                    <!-- /Appointment Tab -->

                    <div class="tab-content">

                        <!-- Upcoming Appointment Tab -->
                        <div class="tab-pane show active" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                            <tr>
                                                <th>Doctor Name</th>
                                                <th>Patient Name</th>
                                                <th>Appt Date</th>
                                                <th>Fee</th>
                                                <th class="text-center">Status</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($upcommingAppointments as $appointment)
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"
                                                               class="avatar avatar-sm me-2">
                                                               <img class="avatar-img rounded-circle"
                                                                   src="{{ asset_img('doctors', $appointment->doctor->profile_image) }}"
                                                                   alt="Patient Image"
                                                               >
                                                            </a>
                                                            <a href="#">{{ $appointment->doctor->name }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"
                                                               class="avatar avatar-sm me-2">
                                                               <img class="avatar-img rounded-circle"
                                                                   src="{{ asset_img('patients' . $appointment->patient->profile_image) }}"
                                                                   alt="Patient Image" >
                                                            </a>
                                                            <a href="#">{{ $appointment->patient->name }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ date('d M Y', strtotime($appointment->appointment_date)) }}
                                                        <span
                                                            class="d-block text-info">{{ date('H:i A', strtotime($appointment->appointment_time)) }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        @php $vat = ($appointment->fee*$appointment->vat) / 100; @endphp
                                                        ${{ number_format($appointment->fee+$vat, 2) }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($appointment->status == 'P')
                                                            <span class="badge rounded-pill bg-warning-light">Pending</span>
                                                        @elseif($appointment->status == 'C')
                                                            <span class="badge rounded-pill bg-success-light">Confirm</span>
                                                        @elseif($appointment->status == 'D')
                                                            <span class="badge rounded-pill bg-danger-light">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="table-action">
                                                            <div class="d-flex justify-content-end gap-3">
                                                                @if($appointment->status == 'P')
                                                                    {{-- <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment)}}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="C">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> Accept
                                                                        </button>
                                                                    </form> --}}
                                                                    {{-- <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment) }}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="D">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                            <i class="fas fa-times"></i> Cancel
                                                                        </button>
                                                                    </form> --}}
                                                                @elseif($appointment->status == 'D')
                                                                    {{-- <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment)}}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="C">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> Accept
                                                                        </button>
                                                                    </form> --}}
                                                                    {{-- <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment) }}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="D">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                            <i class="fas fa-times"></i> Cancel
                                                                        </button>
                                                                    </form> --}}
                                                                @else
                                                                    {{-- <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-success-light">
                                                                        <i class="fas fa-check"></i> Confirmed
                                                                    </a>
                                                                    <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment) }}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="D">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                            <i class="fas fa-times"></i> Cancel
                                                                        </button>
                                                                    </form> --}}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="bg-danger-light">
                                                    <td class="text-center" colspan="6">No appointment available</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Upcoming Appointment Tab -->

                        <!-- Today Appointment Tab -->
                        <div class="tab-pane" id="today-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                            <tr>
                                                <th>Doctor Name</th>
                                                <th>Patient Name</th>
                                                <th>Appt Date</th>
                                                <th>Fee</th>
                                                <th class="text-center">Status</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($todayAppointments as $today_appointment)
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"
                                                               class="avatar avatar-sm me-2">
                                                               <img class="avatar-img rounded-circle"
                                                                   src="{{ asset_img('doctors', $today_appointment->doctor->profile_image) }}"
                                                                   alt="Patient Image">
                                                            </a>
                                                            <a href="#">{{ $today_appointment->doctor->name }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a href="#"
                                                               class="avatar avatar-sm me-2">
                                                               <img class="avatar-img rounded-circle"
                                                                   src="{{ asset_img('patients',  $today_appointment->patient->profile_image) }}"
                                                                   alt="Patient Image">
                                                            </a>
                                                            <a href="#">{{ $today_appointment->patient->name }}</a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ date('d M Y', strtotime($today_appointment->appointment_date)) }}
                                                        <span class="d-block text-info">
                                                            {{ date('H:i A', strtotime($today_appointment->appointment_time)) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        @php $vat = ($today_appointment->fee*$today_appointment->vat) / 100; @endphp
                                                        ${{ number_format($today_appointment->fee+$vat, 2) }}
                                                    </td>
                                                    <td>
                                                        @if($appointment->status == 'P')
                                                            <span class="badge rounded-pill bg-warning-light">Pending</span>
                                                        @elseif($appointment->status == 'C')
                                                            <span class="badge rounded-pill bg-success-light">Confirm</span>
                                                        @elseif($appointment->status == 'D')
                                                            <span class="badge rounded-pill bg-danger-light">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="table-action">
                                                            <div class="d-flex justify-content-end gap-3">
                                                                @if($appointment->status == 'P')
                                                                    {{-- <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment)}}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="C">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> Accept
                                                                        </button>
                                                                    </form>
                                                                    <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment) }}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="D">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                            <i class="fas fa-times"></i> Cancel
                                                                        </button>
                                                                    </form> --}}
                                                                @elseif($appointment->status == 'D')
                                                                    {{-- <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment)}}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="C">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-check"></i> Accept
                                                                        </button>
                                                                    </form>
                                                                    <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment) }}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="D">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                            <i class="fas fa-times"></i> Cancel
                                                                        </button>
                                                                    </form> --}}
                                                                @else
                                                                    {{-- <a href="javascript:void(0);"
                                                                       class="btn btn-sm bg-success-light">
                                                                        <i class="fas fa-check"></i> Confirmed
                                                                    </a>
                                                                    <form method="POST"
                                                                          action="{{ route('update_appointment_status', $appointment) }}">
                                                                        @method('patch')
                                                                        @csrf
                                                                        <input type="hidden" name="status" value="D">
                                                                        <button type="submit" href="javascript:void(0);"
                                                                                class="btn btn-sm bg-danger-light">
                                                                            <i class="fas fa-times"></i> Cancel
                                                                        </button>
                                                                    </form> --}}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="bg-danger-light">
                                                    <td class="text-center" colspan="6">No Appointments found</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Today Appointment Tab -->

                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>

@endsection

