@extends('layout.mainlayout_hospital')
@section('title', 'Appointments')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="page-header p-8 m-2">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">Appointments <span class="ms-1">{{ count($appointments) }}</span></div>
                </div>
            </div>
        </div>
        @if(session()->has('flash'))
            <x-alert>{{ session('flash')['message'] }}</x-alert>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div class="tab-content">

                        <!-- Doctor List -->
                        <div>
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                            <tr>
                                                <th>Doctor</th>
                                                <th>Patient</th>
                                                <th>Appt Date</th>
                                                <th>Booking Date</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th></th>
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
                                                            <a class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-circle"
                                                                    src="{{ asset_img('doctors', $doctor->profile_image) }}"
                                                                    alt="User Image"></a>
                                                            <a>{{ $doctor->name }} <span></span></a>
                                                        </h2>
                                                    </td>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a class="avatar avatar-sm me-2"><img
                                                                    class="avatar-img rounded-circle"
                                                                    src="{{ asset_img('patients', $patient->profile_image) }}"
                                                                    alt="User Image"></a>
                                                            <a>{{ $patient->name }} <span></span></a>
                                                        </h2>
                                                    </td>
                                                    <td>{{ date('d M Y', strtotime($appointment->appointment_date)) }}
                                                        <span
                                                            class="d-block text-info">{{ date('H:i A', strtotime($appointment->appointment_time)) }}</span>
                                                    </td>
                                                    <td>{{ date('d M Y', strtotime($appointment->created_at)) }}</td>
                                                    <td class="text-center">${{ $doctor->pricing }}</td>
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
                                                        <div class="table-action d-flex justify-content-between gap-3">
                                                            {{-- <form method="POST"
                                                                  action="{{ route('update_appointment_status', $appointment) }}">
                                                                @method('patch')
                                                                @csrf
                                                                <input type="hidden" name="status" value="C">
                                                                <button type="submit"
                                                                        class="btn btn-sm bg-success-light">
                                                                    <i class="fas fa-check"></i> Accept
                                                                </button>
                                                            </form>
                                                            <form method="POST"
                                                                  action="{{ route('update_appointment_status', $appointment) }}">
                                                                @method('patch')
                                                                @csrf
                                                                <input type="hidden" name="status" value="D">
                                                                <button type="submit"
                                                                        class="btn btn-sm bg-danger-light">
                                                                    <i class="fas-regular fa-times"></i> Cancel
                                                                </button>
                                                            </form> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="col-span-6">
                                                    <td>No Appointments Available</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Doctor List -->

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
