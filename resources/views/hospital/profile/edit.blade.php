@extends('layout.mainlayout_hospital')
@section('title', 'Edit Profile')
@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="container">
            <!-- Profile Information -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <form method="POST" action="{{ route('hospital.edit.profile') }}"
                              enctype="multipart/form-data">
                            @csrf
                           <!-- Basic -->
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h6>Hopital information</h6>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name"
                                           value="{{ old('name', $hospital_admin->name) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="email"
                                           value="{{ old('email', $hospital_admin->email) }}" required>
                                </div>
                                @if($hospital_admin->username ?? '')
                                    <div class="col-md-4 mb-3">
                                        <label for="username">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="username">@</span>
                                            <input type="text" class="form-control" id="username"
                                                   name="username" placeholder="Username"
                                                   value="{{ $hospital_admin->username }}" required readonly>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4 mb-3">
                                        <label for="username">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="username">@</span>
                                            <input type="text" class="form-control" id="username" name="username"
                                                   placeholder="Username" value="{{old('username')}}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4 mb-3">
                                    <label for="mobile">Phone number</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                           placeholder="+12345678" value="{{ old('mobile', $hospital_admin->mobile) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="profile_image">Profile Image</label>
                                    <input id="profile_image" name="profile_image" class="form-control" type="file">
                                </div>
                            </div>
                            <!-- Description -->
                            <div class="form-row row">
                                <label for="description" class="col-form-label col-md-2">Description</label>
                                <div class="col-md-12 mb-3">
                                <textarea rows="5" cols="5"
                                          id="description"
                                          name="description"
                                          class="form-control"
                                          placeholder="Enter text here"
                                >{{ old('description', $hospital_admin->description) }}</textarea>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="form-row row">
                                <div class="col-md-12 mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           placeholder="Address" value="{{ old('address', $hospital_admin->address) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" class="form-control" id="country" placeholder="Country"
                                           name="country" value="{{ old('country',$hospital_admin->country) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State"
                                           value="{{ old('state', $hospital_admin->state) }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="zip_code">Zip Code</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code"
                                           placeholder="Zip Code" value="{{ old('zip_code',$hospital_admin->zip_code) }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pro-title">
                                    <h6>Social media links</h6>
                                    <p>Please provide correct links to make you accessible.</p>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-md-4 mb-3">
                                    <label for="twitter">Twitter Profile Link</label>
                                    <input type="url" class="form-control" id="twitter" name="twitter"
                                           placeholder="https://www.twitter.com/"
                                           value="{{ old('twitter',$hospital_admin->twitter) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="facebook">Facebook Profile link</label>
                                    <input type="url" class="form-control" id="facebook" name="facebook"
                                           placeholder="https://www.facebook.com/"
                                           value="{{ old('facebook',$hospital_admin->facebook) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="linkedin">Linkedin Profile link</label>
                                    <input type="url" class="form-control" id="linkedin" name="linkedin"
                                           placeholder="https://www.linkedn.com/"
                                           value="{{ old('linkedin', $hospital_admin->linkedin) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="instagram">Instagram Profile link</label>
                                    <input type="url" class="form-control" id="instagram" name="instagram"
                                           placeholder="https://www.instagram.com/"
                                           value="{{ old('instagram', $hospital_admin->instagram) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="youtube">Youtube link</label>
                                    <input type="url" class="form-control" id="youtube" name="youtube"
                                           placeholder="https://www.youbute.com/"
                                           value="{{ old('youtube', $hospital_admin->youtube) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="pinterest">Pinterest link</label>
                                    <input type="url" class="form-control" id="pinterest" name="pinterest"
                                           placeholder="https://www.pinterest.com/"
                                           value="{{ old('pinterest',$hospital_admin->pinterest) }}">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Profile Information -->
        </div>
    </div>
    </div>

    </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
