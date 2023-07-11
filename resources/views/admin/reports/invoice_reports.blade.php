@extends('layout.mainlayout_admin')
@section('title', 'Invoice Reports')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
                <!-- Total Invoice -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title">Invoice Report</h5>
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
                                <div class="income-rev float-none mb-0">Todays Total Invoice : <span>45</span></div>
                                <div id="totsales_chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Total Invoice -->

                <!-- Invoice Report -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="app-listing">
                            <div class="import-list">
                                <a href="#"><i class="feather-download"></i> Import</a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header border-bottom-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title">Invoice List</h5>
                                    </div>
                                    <div class="col-auto d-flex">
                                        <div class="form-custom me-2">
                                            <div id="tableSearch"  class="dataTables_wrapper"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="datatable table table-borderless hover-table" id="data-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Invoice Number</th>
                                            <th>Patient</th>
                                            <th>Created Date</th>
                                            <th>Total Amount</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($invoices as $invoice)
                                            @php
                                            $patient = \App\Models\User::query()->where('id', $invoice->patient_id)->first();
                                            @endphp
                                        <tr>
                                            <td><a href="#" data-bs-toggle="modal" data-bs-target="#transaction"><span class="text-primary user-name">INV 000{{ $loop->index+1 }}</span></a></td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#"><img class="avatar avatar-img" src="{{ asset_img('patients', $patient->profile_image) }}"></a>
                                                    <a href="#"><span class="user-name">{{ $patient->name }}</span></a>
                                                </h2>
                                            </td>
                                            <td><span class="user-name">{{ date('d M Y', strtotime($invoice->appointment_date))}} </span><span class="d-block">{{ date('H:i a', strtotime($invoice->appointment_time)) }}</span></td>
                                            <td>$330.00</td>
                                            <td><span class="badge bg-badge-grey text-success"><i class="fas fa-circle me-1"></i> Paid</span></td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a class="text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                        <i class="feather-trash-2"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div id="tablepagination"  class="dataTables_wrapper"></div>

                    </div>
                </div>
                <!-- /Invoice Report -->
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
