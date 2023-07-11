@extends('layout.mainlayout_admin')
@section('title', 'Income Reports')
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
                                        <h5 class="card-title">Income Report</h5>
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
                                <div class="w-100">
                                    <div class="income-rev">Total Revenue : <span>$451254K</span></div>
                                </div>
                                <div id="totincome-report"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Appointments Report -->

                <!-- Upcoming Appointments -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="app-listing">
                            <div class="custom-list">
                                <div class="SortBy">
                                    <div class="selectBoxes order-by">
                                        <p class="mb-0"><img src="{{ URL::asset('/assets_admin/img/icon/sort.png')}}" class="me-2" alt="icon"> Order by </p>
                                        <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBox">
                                        <form action="income-report">
                                            <p class="lab-title">Order By </p>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> ID
                                            </label>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> Amount
                                            </label>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> Date
                                            </label>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> Number of Appointments
                                            </label>
                                            <p class="lab-title">Sort By</p>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="sort">
                                                <span class="checkmark"></span> Ascending
                                            </label>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="sort">
                                                <span class="checkmark"></span> Descending
                                            </label>
                                            <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="import-list">
                                <a href="#"><i class="feather-download"></i> Import</a>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title">Doctors</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="datatable table table-borderless hover-table" id="data-tables">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Doctor</th>
                                            <th>Specialities</th>
                                            <th>Member Since</th>
                                            <th>Number of Appointments</th>
                                            <th>Total Income</th>
{{--                                            <th>Account Status</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($doctors as $doctor)
                                            @php
                                            $appointments = \App\Models\Appointment::query()->where('doctor_id', $doctor->id)->get();
                                            $total_appointments = count($appointments);
                                            @endphp
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar-pos" href="#"><img class="avatar avatar-img" src="{{ asset_img('doctors', $doctor->profile_image) }}" alt="User Image"></a>
                                                    <a href="{{url('admin/profile')}}" class="user-name">Dr. {{ $doctor->name }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $doctor->speciality->name }}</td>
                                            <td><span class="user-name">{{ $doctor->created_at->format('d M Y') }} </span></td>
                                            <td>{{ $total_appointments }}</td>
                                            @if($doctor->pricing == 'Free')
                                            <td>Free</td>
                                            @else
                                            <td>${{ $total_appointments*$doctor->pricing }}.00</td>
                                            @endif
{{--                                            <td>--}}
{{--                                                <label class="toggle-switch" for="status1">--}}
{{--                                                    <input type="checkbox" class="toggle-switch-input" id="status1">--}}
{{--                                                    <span class="toggle-switch-label">--}}
{{--																<span class="toggle-switch-indicator"></span>--}}
{{--															</span>--}}
{{--                                                </label>--}}
{{--                                            </td>--}}
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

                <div id="tablepagination"  class="dataTables_wrapper"></div>
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
