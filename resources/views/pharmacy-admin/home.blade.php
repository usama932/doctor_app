@extends('layout.mainlayout_pharmacy_admin')
@section('title', 'Dashboard')
@section('content')

<!-- Page Wrapper -->
			<div class="page-wrapper">
				<div class="content container-fluid pb-0">

					<h4 class="mb-3">Overview</h4>

					<div class="row">
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-primary">
											<i class="feather-dollar-sign"></i>
										</span>
										<div class="dash-count">
											<h5 class="dash-title">Sales Today</h5>
											<div class="dash-counts">
												<p>$50.00</p>
											</div>
										</div>
									</div>
									<p class="trade-level mb-0"><span class="text-danger me-1"><i class="fas fa-caret-down me-1"></i>2.05%</span> last week</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-blue">
											<i class="feather-credit-card"></i>
										</span>
										<div class="dash-count">
											<h5 class="dash-title">Expense Today</h5>
											<div class="dash-counts">
												<p>$5.22</p>
											</div>
										</div>
									</div>
									<p class="trade-level mb-0"><span class="text-success me-1"><i class="fas fa-caret-up me-1"></i>4.5%</span> last week</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-warning">
											<i class="feather-folder-plus"></i>
										</span>
										<div class="dash-count">
											<h5 class="dash-title">Medicine</h5>
											<div class="dash-counts">
												<p>485</p>
											</div>
										</div>
									</div>
									<p class="trade-level mb-0"><span class="text-success me-1"><i class="fas fa-caret-up me-1"></i>9.65%</span> last week</p>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-sm-6 col-12">
							<div class="card">
								<div class="card-body">
									<div class="dash-widget-header">
										<span class="dash-widget-icon bg-danger">
											<i class="feather-users"></i>
										</span>
										<div class="dash-count">
											<h5 class="dash-title">Staff</h5>
											<div class="dash-counts">
												<p>50</p>
											</div>
										</div>
									</div>
									<p class="trade-level mb-0"><span class="text-danger me-1"><i class="fas fa-caret-up me-1"></i>40.5%</span> last week</p>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<!-- Appointments -->
						<div class="col-xl-7 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Revenue</h5>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div id="sales_chart"></div>
								</div>
							</div>
						</div>
						<!-- /Appointments -->

						<!-- Income Report -->
						<div class="col-xl-5 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Status</h5>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div id="income-report"></div>
								</div>
							</div>
						</div>
						<!-- /Income Report -->
					</div>

					<div class="row">
						<!-- Recent Activities -->
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header border-bottom-0">
									<div class="row align-items-center">
										<div class="col">
											<h5 class="card-title">Latest Customers</h5>
										</div>
										<div class="col-auto d-flex">
											<div class="bookingrange btn btn-white btn-sm">
												<div class="cal-ico">
													<span>Select Date</span>
													<i class="feather-chevron-down ms-1"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body p-0">
									<div class="table-responsive">
										<table class="table table-borderless hover-table">
											<thead class="thead-light">
												<tr>
												   <th>#</th>
												   <th>Name</th>
												   <th>Address</th>
												   <th>Telephone</th>
												   <th>Email</th>
												   <th class="text-end">Date added</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>01</td>
													<td><a href="{{url('pharmacy-admin/profile')}}">Ruby Perrin</a></td>
													<td>takrakka</td>
													<td>+54 1245463984</td>
													<td>rubyperring@example.com</td>
													<td class="text-end">April 14, 2022</td>
												</tr>
												<tr>
													<td>02</td>
													<td><a href="{{url('pharmacy-admin/profile')}}">Darren Elder</a></td>
													<td>339, Terromont Street</td>
													<td>+44 874654536</td>
													<td>darrenelder@example.com</td>
													<td class="text-end">December 15, 2022</td>
												</tr>
												<tr>
													<td>03</td>
													<td><a href="{{url('pharmacy-admin/profile')}}">Deborah Angel</a></td>
													<td>339, Terromont Street</td>
													<td>+0144 763 351</td>
													<td>deborahangel@example.com</td>
													<td class="text-end">January 22, 2022</td>
												</tr>
												<tr>
													<td>04</td>
													<td><a href="{{url('pharmacy-admin/profile')}}">Marsha Burke</a></td>
													<td>2061 Angus Road</td>
													<td>+510-306-7033</td>
													<td>marshaburke@example.com</td>
													<td class="text-end">August 13, 2022</td>
												</tr>
												<tr>
													<td>05</td>
													<td><a href="{{url('pharmacy-admin/profile')}}">Krystyna Rodriquez</a></td>
													<td>takrakka</td>
													<td>+54 8965722222</td>
													<td>krystynarodriquez@example.com</td>
													<td class="text-end">May 01, 2022</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!-- /Recent Activities -->
					</div>

				</div>
			</div>
			<!-- /Page Wrapper -->

		</div>
		<!-- /Main Wrapper -->

@endsection
