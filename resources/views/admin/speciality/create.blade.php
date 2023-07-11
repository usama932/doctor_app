@extends('layout.mainlayout_admin')
@section('title', 'Specialities')
@section('content')
    <div class="page-wrapper">

        <!-- Specialities -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Add Speciality</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('speciality.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-2">Speciality name</label>
                                <div class="col-md-10">
                                    <input id="name" name="name" type="text" class="form-control"
                                           placeholder="Enter Speciality name" required>
                                    @error('name')
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
                            <button class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Add
                                Speciality
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
