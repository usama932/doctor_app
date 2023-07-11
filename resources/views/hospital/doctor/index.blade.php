@extends('layout.mainlayout_hospital')
@section('title', 'Hospital Doctors')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="page-header p-8 m-2">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">Doctors <span class="ms-1">{{ count($doctors) }}</span></div>
                    <a href="{{ route('doctor.create') }}" class="btn btn-primary btn-add"><i
                            class="feather-plus-square me-1"></i> Add New</a>
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
                                                <th>Speciality</th>
                                                <th>Address</th>
                                                <th>Fee</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($doctors as $doctor)
                                                <tr>
                                                    <td>
                                                        <h2 class="table-avatar">
                                                            <a class="avatar avatar-sm me-2">
                                                                <img class="avatar-img rounded-circle"
                                                                    src="{{ asset_img('doctors', $doctor->profile_image) }}"
                                                                    alt="User Image">
                                                                </a>
                                                            <a>{{ $doctor->name }}</a>
                                                        </h2>
                                                    </td>
                                                    @if($doctor->speciality_id ?? '')
                                                        <td>{{ $doctor->speciality->name }}</td>
                                                    @else
                                                        <td>N/A</td>
                                                    @endif
                                                    <td>
                                                        @if($doctor->address ?? '')
                                                            <span class="user-name">{{ $doctor->address }} </span>
                                                            <span class="d-block">{{ $doctor->state }}</span>
                                                            <span class="d-block">{{ $doctor->country }}</span>
                                                        @else
                                                            <span class="d-block">No Address Found</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">${{ $doctor->pricing }}</td>
                                                    <td class="text-end">
                                                        <div class="table-action">
                                                            <a href="{{ route('doctor.edit', $doctor) }}"
                                                               class="btn btn-sm bg-success-light">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                               onclick="if (window.confirm('Are you sure you want to delete this hospital <{{ $doctor->name }} >')){ document.getElementById( 'delete{{ $doctor->id }}').submit(); }"

                                                               class="btn btn-sm bg-danger-light">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <form method="POST" id="delete{{ $doctor->id }}"
                                                          action="{{ route('doctor.destroy', $doctor) }}">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </tr>
                                            @empty
                                                <tr class="col-span-6">
                                                    <td>No Doctors Available</td>
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
