<?php $page = "doctor-dashboard"; ?>
@extends('layout.mainlayout_doctor')
@section('title', 'Appointments')
@section('content')
    {{-- Page Content --}}
    <div class="col-md-7 col-lg-8 col-xl-9">
        @if(session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="container">
            <div class="appointments">
                @forelse($appointments as $appointment)
                    @php
                    $patient = $appointment->patient;
                    @endphp
                <div class="appointment-list">
                    <div class="profile-info-widget">
                        <a href="patient-profile.html" class="booking-doc-img">
                            <img src="{{asset_img('patients', $patient->profile_img)}}">
                        </a>
                        <div class="profile-det-info">
                            <h3><a href="patient-profile.html">{{ $patient->name }}</a></h3>
                            <div class="patient-details">
                                <h5><i class="far fa-clock"></i> {{ date('F d, Y', strtotime($appointment->appointment_date)) }}, {{ date('h:i A', strtotime($appointment->appointment_time)) }}</h5>
                                {{-- <h5><i class="fas fa-map-marker-alt"></i> {{ $patient->address }}, {{ $patient->state }}</h5> --}}
                                <h5><i class="fas fa-envelope"></i> {{ $patient->email }}</h5>
                                <h5 class="mb-0"><i class="fas fa-phone"></i>{{ $patient->mobile }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="appointment-action gap-3">
                        @if($appointment->status == 'P')
                            {{-- <form method="POST" action="{{ route('update_appointment_status', $appointment)}}">
                                @method('patch')
                                @csrf
                                <input type="hidden" name="status" value="C">
                                <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                    <i class="fas fa-check"></i> Accept
                                </button>
                            </form>
                            <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                @method('patch')
                                @csrf
                                <input type="hidden" name="status" value="D">
                                <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                            </form> --}}
                        @elseif($appointment->status == 'D')
                            {{-- <form method="POST" action="{{ route('update_appointment_status', $appointment)}}">
                                @method('patch')
                                @csrf
                                <input type="hidden" name="status" value="C">
                                <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                    <i class="fas fa-check"></i> Accept
                                </button>
                            </form>
                            <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                @method('patch')
                                @csrf
                                <input type="hidden" name="status" value="D">
                                <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                            </form> --}}
                        @else
                            {{-- <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                <i class="fas fa-check"></i> Confirmed
                            </a>
                            <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                @method('patch')
                                @csrf
                                <input type="hidden" name="status" value="D">
                                <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                    <i class="fas fa-times"></i> Cancel
                                </button>
                            </form> --}}
                        @endif
                    </div>
                </div>
                @empty
                <div class="appointment-list">
                    <div class="appointment-action">
                        <p href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                            <i class="fas fa-times"></i> No Appointments Available
                        </p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>

@endsection

