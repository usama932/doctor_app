@extends('layout.mainlayout_admin')
@section('title', 'Patient')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-12 d-flex justify-content-end">
                        <div class="doc-badge me-3">Patients <span
                                class="ms-1">{{ $patients->count() }}</span>
                        </div>
                        <a href="{{ route('patient.create') }}" class="btn btn-primary btn-add"><i
                                class="feather-plus-square me-1"></i> Add New</a>
                    </div>
                </div>
            </div>
            @if(session()->has('flash'))
                <x-alert>{{ session('flash')['message'] }}</x-alert>
            @endif
            <!-- Patients List -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="card-title">Patients</h5>
                                </div>
                                <div class="col-auto custom-list d-flex">
                                    <div class="form-custom me-2">
                                        <div id="tableSearch" class="dataTables_wrapper"></div>
                                    </div>
                                    <div class="multipleSelection">
                                        <div class="selectBox">
                                            <p class="mb-0"><i class="feather-filter me-1"></i> Filter </p>
                                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                        </div>
                                        <div id="checkBoxes">
                                            <form action="patient-list">
                                                <p class="lab-title">By Account status</p>
                                                <div class="selectBox-cont">
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="acc" checked>
                                                        <span class="checkmark"></span> Enabled
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="acc">
                                                        <span class="checkmark"></span> Disabled
                                                    </label>
                                                    <p class="lab-title">By Blood Type</p>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> AB+
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> O-
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> B-
                                                    </label>
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> A+
                                                    </label>
                                                    <label class="custom_check w-100 mb-4">
                                                        <input type="checkbox" name="year">
                                                        <span class="checkmark"></span> B+
                                                    </label>
                                                </div>
                                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="datatable table table-borderless hover-table" id="data-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient</th>
                                        <th>Email</th>
                                        <th>Blood group</th>
                                        <th>Account Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($patients as $patient)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="avatar avatar-sm me-2">
                                                        <img class="avatar-img rounded-circle" src="{{ asset_img('patients', $patient->profile_image) }}">
                                                    </a>
                                                    <a href="#"><span class="user-name">{{ $patient->name }}</span>
                                                        <span class="text-muted">{{$patient->gender}}, {{$patient->age}} Years Old</span></a>
                                                </h2>
                                            </td>
                                            <td><span class="user-name">{{$patient->email}}</span><span class="d-block"><span>@</span>{{$patient->username}}</span></td>
                                            @if( $patient->blood_group ?? '')
                                                <td>{{ $patient->blood_group }}</td>
                                            @else
                                                <td>N\A</td>
                                            @endif

                                            <td>
                                                @php
                                                    $btnClr = "success";
                                                    if ($patient->status == "Inactive") {
                                                        $btnClr = "danger";
                                                    }
                                                @endphp
                                                <span class="badge rounded-pill bg-{{$btnClr}}-light">{{$patient->status}}</span>
                                            </td>

                                            {{--                                <td>--}}
                                            {{--                                    <label class="toggle-switch" for="status1">--}}
                                            {{--                                        <input type="checkbox" class="toggle-switch-input" id="status1">--}}
                                            {{--                                        <span class="toggle-switch-label">--}}
                                            {{--																<span class="toggle-switch-indicator"></span>--}}
                                            {{--															</span>--}}
                                            {{--                                    </label>--}}
                                            {{--                                </td>--}}
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a class="text-black" href="{{ route('patient.edit', $patient) }}">
                                                        <i class="feather-edit-3 me-1"></i> Edit
                                                    </a>
                                                    <a class="text-danger" href="javascript:void(0);"
                                                       onclick="if (window.confirm('Are you sure you want to delete this hospital <{{ $patient->name }} >')){ document.getElementById( 'delete{{ $patient->id }}').submit(); }"
                                                    >
                                                        <i class="feather-trash-2 me-1"></i> Delete
                                                    </a>
                                                </div>
                                            </td>
                                            <form method="POST" id="delete{{ $patient->id }}"
                                                  action="{{ route('patient.destroy', $patient) }}">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="tablepagination" class="dataTables_wrapper"></div>
                </div>
            </div>
            <!-- /Patient List -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
