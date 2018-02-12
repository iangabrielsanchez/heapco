<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
	    crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css" /> @yield('styles')
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:600" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
	<link rel="shortcut icon" type="image/png" href="" >
</head>

<body>
	@if(session('accountType') === null)
		@if((
			($var = App\PersonnelProfile::where('email', Auth::user()->email)
				->where('type','Doctor'))->count()) > 0)
			<?php session(['accountType' => 'doctor']); ?>
			<?php session(['accountID' => $var->first()->id]); ?>
			
		@elseif((
			($var = App\PersonnelProfile::where('email', Auth::user()->email)
				->where('type','Nurse'))->count()) > 0)
			<?php session(['accountType' => 'nurse']); ?>
			<?php session(['accountID' => $var->first()->id]); ?>
		@elseif((
			($var = App\Patient::where('email', Auth::user()->email))->count()) > 0)
			<?php session(['accountType' => 'patient']); ?>
			<?php session(['accountID' => $var->first()->id]); ?>
		@else
			<?php session(['accountType' => 'admin']); ?>
		@endif
	@endif
	<div id="app">
		<nav class="navbar navbar-default navbar-fixed-top nav1">
			<ul class="nav sidebar-nav">
				<li class="sidebar-brand">
					<a href="/">
						<h3>HeapCo
							{{--  <i class="fa fa-bars" id='menu' aria-hidden="true"></i>  --}}
							<i class="fa fa-stethoscope" id ='menu'></i>
						</h3>
					</a>
				</li>
				@if (session('accountType') == 'doctor')
				<li>
					<a href="/forums">
						<i class="fa fa-comments fa-2x" id='navicon' aria-hidden="true"></i>
						Forums
					</a>
				</li>
				<li>
					<a href="/patients">
						<i class="fa fa-users fa-2x" id='navicon' aria-hidden="true"></i>
						Patients List
					</a>
				</li>
				<li>
					<a href="/mypatients">
						<i class="fa fa-user fa-2x" id='navicon' aria-hidden="true"></i>
						My Patients
					</a>
				</li>
				@elseif (session('accountType') == 'nurse')
				<li>
					<a href="/patients">
						<i class="fa fa-user fa-2x" id='navicon' aria-hidden="true"></i>
						Patients
					</a>
				</li>
				@elseif (session('accountType') == 'patient')
				<li>
					<a href="/patients/{{session('accountID')}}">
						<i class="fa fa-user fa-2x" id='navicon' aria-hidden="true"></i>
						Patient Profile
					</a>
				</li>
				@elseif (session('accountType') == 'admin')
				<li>
					<a href="/hospitals">
						<i class="fa fa-hospital-o fa-2x" id='navicon' aria-hidden="true"></i>
						Hospitals List
					</a>
				</li>
				<li>
					<a href="/accounts">
						<i class="fa fa-user-md fa-2x" id='navicon' aria-hidden="true"></i>
						Personnel Accounts
					</a>
				</li>
				<li>
					<a href="/patients">
						<i class="fa fa-user fa-2x" id='navicon' aria-hidden="true"></i>
						Patient Profile
					</a>
				</li>
				<li>
					<a href="/register">
						<i class="fa fa-user-secret fa-2x" id='navicon' aria-hidden="true"></i>
						Administrators
					</a>
				</li>
				<!-- <li>
					<a data-toggle="modal" data-target="#info" href="#">
						<i>Information</i>
					</a>
				</li> -->
				@endif
				
			</ul>
		</nav>
		<nav class="navbar navbar-default navbar-fixed-top nav2">
			<div class="container-fluid">
				<ul class="nav navbar-nav navbar-right">
					<a class="navbar-brand" href="#">
						<h3>Healthcare Practitioner's Companion</h3>
					</a>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							{{Auth::user()->name}}
							<i class="fa fa-angle-down" aria-hidden="true"></i>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="{{'/accounts/'.session('accountID')}}">My Profile</a>
							</li>
							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<div id="info" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Information</h4>
					</div>
					<form class="form-horizontal" method="POST" action="">
						<div class="modal-body">

							<div class="panel-body">
								<p>
									This web app is in demo mode. This is not the final design -- not even close. This is to just show you the features
									<br/>
									<b>Current features:</b>
									<ul>
										<li>Accounts
											<ul>
												<li>Adding Personnel Accounts (for doctors and nurses)</li>
												<li>Visualizing of the database data.</li>
												<li>
													<b>Notes:</b>
													<ul>
														<li>A hospital must first be created before adding personnel accounts.</li>
														<li>There will be two types of log in. Personnel Login and Admin Login. That's the purpose of the password field</li>
													</ul>
												</li>
											</ul>
										</li>
										<li>Patients
											<ul>
												<li>Adding Patient Accounts</li>
												<li>Visualizing of the database data.</li>
											</ul>
										</li>
										<li>Hospitals
											<ul>
												<li>Adding Hospitals</li>
												<li>Visualizing of the database data.</li>
											</ul>
										</li>
										<li>Forums
											<ul>
												<li>Adding Posts</li>
												<li>Posts feed</li>
												<li>Comments</li>
											</ul>
										</li>
									</ul>
								</p>
							</div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>

					</form>

				</div>

			</div>
		</div>
		<div class="content">
			<section class="page-title">
				<h3>
					@yield('pageTitle')
				</h3>
			</section>
			@yield('content')
		</div>
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
	@yield('script')
</body>

</html>