@extends('layout.mainlayout_index1')
@section('title', 'Invcoices')
@section('content')
    <!-- Header -->
    @include('components.patient_header')
    <!-- /Header -->
    <div class="row align-items-center mt-4"></div>
    </div>
</section>
<!-- Page Content -->
<section class="about-us">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('layout.partials.nav_patient')
                <div class="col-md-7 col-lg-8 col-xl-9">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0">
                                    <thead>
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Amount</th>
                                        <th>Created At</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($invoices as $invoice)
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{route("doctor_profile",$invoice->doctor->id)}}" class="avatar avatar-sm me-2">
                                                    <img class="avatar-img rounded-circle" src="{{ asset_img("doctors", $invoice->doctor->profile_image) }}">
                                                </a>
                                                <a href="{{route("doctor_profile",$invoice->doctor->id)}}">{{ $invoice->doctor->name }}</a>
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
</section>
@endsection

