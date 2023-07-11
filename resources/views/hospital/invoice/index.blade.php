@extends('layout.mainlayout_hospital')
@section('title', 'Invoices')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card card-table">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0">
                        <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Patient</th>
                            <th>Amount</th>
                            <th>Created At</th>
                            <th>Payment Status</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="doctor-profile.html" class="avatar avatar-sm me-2">
                                        <img class="avatar-img rounded-circle" src="{{ asset_img('doctors', $invoice->doctor->profile_image) }}" alt="Doctor Image">
                                    </a>
                                    <a href="doctor.html">{{ $invoice->doctor->name }}</a>
                                </h2>
                            </td>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="patient-profile.html" class="avatar avatar-sm me-2">
                                        <img class="avatar-img rounded-circle" src="{{ asset_img('patients', $invoice->patient->profile_image) }}" alt="User Image">
                                    </a>
                                    <a href="patient-profile.html">{{ $invoice->patient->name }}</a>
                                </h2>
                            </td>
                            <td>
                                @php $vat = ($invoice->fee*$invoice->vat) / 100; @endphp
                                ${{ number_format($invoice->fee+$vat, 2) }}
                            </td>
                            <td>{{ date('d M Y', strtotime($invoice->created_at)) }}
                                <span
                                    class="d-block text-info">{{ date('H:i A', strtotime($invoice->created_at)) }}</span>
                            </td>
                            <td class="text-center">
                                @php $btn = 'danger'; @endphp
                                @if ($invoice->payment_status == "Paid")
                                @php $btn = 'success'; @endphp
                                @endif
                                <button class="btn btn-sm bg-{{$btn}}-light">
                                    {{$invoice->payment_status}}
                                </button>
                            </td>
                            <td class="text-center">
                                <div class="table-action">
                                    <a href="{{ route('show_invoice', $invoice) }}" class="btn btn-sm bg-info-light">
                                        <i class="far fa-eye"></i> View
                                    </a>
                                    <form class="d-inline" action="{{route('invoice.change.payment.status', $invoice)}}" method="POST">
                                        @csrf
                                        @php
                                            $btnCls = "danger";
                                            $btnTxt = "Mark as Unpaid";
                                            $btnIco = "times";
                                            if($invoice->payment_status == "Unpaid"){
                                                $btnCls = "success";
                                                $btnTxt = "Mark as Paid";
                                                $btnIco = "check";
                                            }
                                        @endphp
                                        <button type="submit" class="btn btn-sm bg-{{$btnCls}}-light">
                                            <i class="fas fa-{{$btnIco}}"></i> {{$btnTxt}}
                                        </button>
                                    </form>
{{--                                    <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">--}}
{{--                                        <i class="fas fa-print"></i> Print--}}
{{--                                    </a>--}}
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr class="bg-danger-light">
                                <td class="text-center" colspan="5">No Appointments found</td>
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
    <!-- /Page Content -->
    </div>
@endsection
