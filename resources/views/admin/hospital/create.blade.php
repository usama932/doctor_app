@extends('layout.mainlayout_admin')
@section('title', 'Add New Hospital')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add New Hospital</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('hospital.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="hospital_name" class="col-form-label col-md-2">Hospital name</label>
                                <div class="col-md-10">
                                    <input id="hospital_name" name="hospital_name" type="text" class="form-control"
                                           placeholder="Enter Hospital name" required>
                                    @error('hospital_name')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-form-label col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input id="address" name="address" type="text" class="form-control"
                                           placeholder="Enter Hospital Location" required>
                                    @error('address')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="city" class="col-form-label col-md-2">City</label>
                                <div class="col-md-10">
                                    <input id="city" name="city" type="text" class="form-control"
                                           placeholder="Enter Hospital Location" required>
                                    @error('city')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-form-label col-md-2">Country</label>
                                <div class="col-md-10">
                                    <input id="country" name="country" type="text" class="form-control"
                                           placeholder="Enter Hospital Location" required>
                                    @error('country')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="state" class="col-form-label col-md-2">State</label>
                                <div class="col-md-10">
                                    <input id="state" name="state" type="text" class="form-control"
                                           placeholder="Enter Hospital Location" required>
                                    @error('state')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="zip" class="col-form-label col-md-2">Hospital Zip</label>
                                <div class="col-md-10">
                                    <input id="zip" name="zip" type="text" class="form-control"
                                           placeholder="Enter Hospital Zip Code" required>
                                    @error('zip')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-form-label col-md-2">Image</label>
                                <div class="col-md-10">
                                    <input id="image" name="image" class="form-control" type="file" required>
                                    @error('image')
                                    <div class="text-danger pt-2">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">Hospital Administrator name</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control"
                                           placeholder="Enter Hospital Administrator name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-2">Hospital Administrator email</label>
                                <div class="col-md-10">
                                    <input id="email" name="email" type="email" class="form-control"
                                           placeholder="Enter Hospital Administrator email">
                                </div>
                            </div>
                            <input type="hidden" value="H" name="user_type" id="user_type">
                            <input type="hidden" name="hospital_id" id="hospital_id">
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Add
                                Hospital
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Specialities -->
    </div>
    </div>
    <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

@endsection
