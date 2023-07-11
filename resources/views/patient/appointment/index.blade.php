@extends('layout.mainlayout_index1')
@section('title', 'Appointments')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->

    <div class="row align-items-center mt-4"></div>
    </div>
    </section>
    <!-- /Home Banner -->
    <section class="about-us">
        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    @include('layout.partials.nav_patient')

                    <div class="col-md-7 col-lg-8 col-xl-9">

                        <div class="row">
                            <div class="tab-content pt-0">
                                @if(session()->has('flash'))
                                    <x-alert>{{ session('flash')['message'] }}</x-alert>
                                @endif
                                <div id="pat_appointments" class="tab-pane fade show active">
                                    <div class="card card-table mb-0">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-center mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>Doctor</th>
                                                        <th>Appointment Date</th>
                                                        <th>Booking Date</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @forelse($appointments as $appointment)
                                                    <tr>
                                                        <td>
                                                            <h2 class="table-avatar">
                                                                <a href="{{route("doctor_profile",$appointment->doctor->id)}}" class="avatar avatar-sm me-2">
                                                                    <img class="avatar-img rounded-circle" src="{{ asset_img("doctors", $appointment->doctor->profile_image) }}">
                                                                </a>
                                                                <a href="{{route("doctor_profile",$appointment->doctor->id)}}">Dr. {{ $appointment->doctor->name }} <span>{{ $appointment->doctor->speciality->name ?? null }}</span></a>
                                                            </h2>
                                                        </td>
                                                        <td>{{ date('d M Y', strtotime($appointment->appointment_date)) }} <span class="d-block text-info">{{ date('H:i A', strtotime($appointment->appointment_time)) }}</span></td>
                                                        <td>{{ date('d M Y', strtotime($appointment->created_at)) }}</td>
                                                        <td>
                                                            @php $vat = ($appointment->fee*$appointment->vat) / 100; @endphp
                                                            ${{ number_format($appointment->fee+$vat, 2) }}
                                                        </td>
                                                        @if($appointment->status == 'P')
                                                            <td><span class="badge rounded-pill bg-warning-light">Pending</span></td>
                                                        @elseif($appointment->status == 'C')
                                                            <td><span class="badge rounded-pill bg-success-light">Confirm</span></td>
                                                        @elseif($appointment->status == 'D')
                                                            <td><span class="badge rounded-pill bg-danger-light">Cancelled</span></td>
                                                        @endif
                                                        @if($appointment->status == 'D')
                                                        <td class="text-end">
                                                            <form method="POST" action="{{ route('update_appointment_status', $appointment)}}">
                                                                @method('patch')
                                                                @csrf
                                                                <input type="hidden" name="status" value="P">
                                                                <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-success-light">
                                                                    <i class="fas fa-check"></i> Book Again
                                                                </button>
                                                            </form>

                                                            <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                                                @method('patch')
                                                                @csrf
                                                                <input type="hidden" name="status" value="D">
                                                                <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                                                    <i class="fas fa-times"></i> Cancel
                                                                </button>
                                                            </form>
                                                        </td>
                                                        @else
                                                            <td class="text-end">
                                                                <div></div>
                                                                <form method="POST" action="{{ route('update_appointment_status', $appointment) }}">
                                                                    @method('patch')
                                                                    @csrf
                                                                    <input type="hidden" name="status" value="D">
                                                                    <button type="submit" href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                                                                        <i class="fas fa-times"></i> Cancel
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        @endif
{{--                                                        <td class="text-end">--}}
{{--                                                            <div class="table-action">--}}
{{--                                                                <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">--}}
{{--                                                                    <i class="fas fa-print"></i> Print--}}
{{--                                                                </a>--}}
{{--                                                                <a href="javascript:void(0);" class="btn btn-sm bg-info-light">--}}
{{--                                                                    <i class="far fa-eye"></i> View--}}
{{--                                                                </a>--}}
{{--                                                            </div>--}}
{{--                                                        </td>--}}
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td class="col-span-6">
                                                            <h3 class="bg-danger-light">No record found</h3>
                                                        </td>
                                                    </tr>
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
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </section>
@endsection


