@extends('layout.mainlayout_index1')
@section('title', 'Invoice view')
@section('content')
<!-- Page Content -->
<section class="about-us">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('layout.partials.nav_patient')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="invoice-content">
                        <div class="invoice-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="invoice-logo">
                                        <img src="{{ asset('assets/img/logo.jpg') }}" alt="logo" style="height: 3rem;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="invoice-details">
                                        <strong>Issued:</strong> {{ date('M, d Y', strtotime($invoice->created_at)) }}
                                    </p>
                                    <p class="invoice-details">
                                        <strong>Appointment Date:</strong> {{ date('M, d Y', strtotime($invoice->appointment_date)) }} {{ date('H:i', strtotime($invoice->appointment_time)) }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="invoice-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="invoice-info">
                                        <strong class="customer-text">Invoice From</strong>
                                        <p class="invoice-details invoice-details-two">
                                            Dr. {{ $invoice->doctor->name }} <br>
                                            {{ $invoice->doctor->address }},<br>
                                            {{ $invoice->doctor->state }}, {{ $invoice->doctor->country}} <br>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="invoice-info invoice-info2">
                                        <strong class="customer-text">Invoice To</strong>
                                        <p class="invoice-details">
                                            {{ $invoice->patient->name }} <br>
                                            {{ $invoice->patient->address }} <br>
                                            {{ $invoice->patient->state }}, {{ $invoice->patient->country }} <br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="invoice-item">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="invoice-info">
                                        <strong class="customer-text">Payment Information</strong>
                                        <p class="invoice-details invoice-details-two">
                                            @if ($invoice->payment_status == 'Paid')
                                                <strong>Payment Status: </strong><span class="text-success">{{$invoice->payment_status}}</span> <br>
                                                <strong>Payment Date: </strong><span class="">{{date("M d, Y",strtotime($invoice->payment_date))}}</span> <br>
                                            @else
                                                <strong>Payment Status: </strong><span class="text-danger">{{$invoice->payment_status}}</span> <br>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="invoice-item invoice-table-wrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="invoice-table table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th class="text-center">VAT</th>
                                                <th class="text-end">Fee</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>General Consultation</td>
                                                <td class="text-center">
                                                    @php
                                                        $vat = ($invoice->fee*$invoice->vat) / 100;
                                                    @endphp
                                                    ${{number_format($vat, 2)}} <small>({{$invoice->vat}}%)</small>
                                                </td>
                                                <td class="text-end">${{ number_format($invoice->fee, 2) }}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4 ms-auto">
                                    <div class="table-responsive">
                                        <table class="invoice-table-two table">
                                            <tbody>
                                            <tr>
                                                <th>Subtotal:</th>
                                                <td><span>${{ number_format($invoice->fee+$vat, 2) }}</span></td>
                                            </tr>
                                            {{-- <tr>
                                                <th>Discount:</th>
                                                <td><span>-10%</span></td>
                                            </tr> --}}
                                            <tr>
                                                <th>Total Amount:</th>
                                                <td><span>${{ number_format($invoice->fee+$vat, 2) }}</span></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="other-info">
                            <h4>Other information</h4>
                            <p class="text-muted mb-0">{!! $invoiceSettings->get("footer_text") !!}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Page Content -->
@endsection

