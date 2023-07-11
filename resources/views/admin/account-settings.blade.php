<?php $page="account-settings";?>
@extends('layout.mainlayout_admin')
@section('content')

		<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid content-wrap">
					
					<!-- Product List -->
					<div class="row">
						<div class="col-md-12">
							<ul class="list-links mb-4">
								<li class="active"><a href="{{url('admin/account-settings')}}">Account Settings</a></li>
								<li><a href="{{url('admin/change-password')}}">Change Password</a></li>
							</ul>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="acc-wrap">
								<h6>Acccount Information</h6>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group form-focus">
										<input type="text" class="form-control floating">
										<label class="focus-label">User Name</label>
									</div>
									<div class="form-group form-focus">
										<input type="email" class="form-control floating">
										<label class="focus-label">Email Id</label>
									</div>
									<div class="form-group form-focus">
										<input type="email" class="form-control floating">
										<label class="focus-label">Alternate Email</label>
									</div>
									<div class="form-group form-focus">
										<input type="text" class="form-control floating">
										<label class="focus-label">Phone number</label>
									</div>
								</div>
							</div>
							<div class="acc-wrap">
								<h6>Social Media</h6>
								<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group form-focus">
										<input type="text" class="form-control floating">
										<label class="focus-label">Facebook</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group form-focus">
										<input type="text" class="form-control floating">
										<label class="focus-label">Twitter</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group form-focus">
										<input type="text" class="form-control floating">
										<label class="focus-label">Linkedin</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group form-focus">
										<input type="text" class="form-control floating">
										<label class="focus-label">Instagram</label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group form-focus">
										<input type="text" class="form-control floating">
										<label class="focus-label">YouTube</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row mt-auto">
						<div class="col-md-12">
							<div class="submit-sec">
								<button type="submit" class="btn btn-primary">Save Changes</button>
								<button class="btn btn-secondary">Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->
			
		</div>
		<!-- /Main Wrapper -->
 
@endsection