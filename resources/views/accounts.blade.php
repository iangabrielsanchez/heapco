@extends('layouts.app') 
@section('pageTitle')

@endsection
@section('content')
<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">New Personnel</button>
					<h3>Personnel Accounts</h3>
				</div>


				<div class="panel-body">
					<table id="tblAccounts" class=" table table-hover display" cellspacing="0" width="100%">
					</table>
				</div>

			</div>

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">New Account</h4>
						</div>
						<form class="form-horizontal" method="POST" action="">
							<div class="modal-body">

								<div class="panel-body">


									{{ csrf_field() }}


									<div class="form-group">
										<label for="first_name" class="col-md-4 control-label">First Name</label>
										<div class="col-md-6">
											<input id="first_name" type="text" class="form-control" name="first_name" required autofocus>
										</div>
									</div>

									<div class="form-group">
										<label for="last_name" class="col-md-4 control-label">Last Name</label>
										<div class="col-md-6">
											<input id="last_name" type="text" class="form-control" name="last_name" required autofocus>
										</div>
									</div>

									<div class="form-group">
										<label for="contact_number" class="col-md-4 control-label">Contact Number</label>
										<div class="col-md-6">
											<input id="contact_number" type="text" class="form-control" name="contact_number" required autofocus>
										</div>
									</div>

									<div class="form-group">
										<label for="email" class="col-md-4 control-label">E-Mail Address</label>
										<div class="col-md-6">
											<input id="email" type="email" class="form-control" name="email" required autofocus>
										</div>
									</div>

									<div class="form-group">
										<label for="password" class="col-md-4 control-label">Password</label>
										<div class="col-md-6">
											<input id="password" type="password" class="form-control" name="password" required>
										</div>
									</div>



									<div class="form-group">
										<label for="sex" class="col-md-4 control-label">Sex</label>
										<div class="col-md-6">
											<select class="form-control" id="sex" name="sex" required>
												<option value="M">Male</option>
												<option value="F">Female</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="birth_date" class="col-md-4 control-label">Birth Date</label>
										<div class="col-md-6">
											<input id="birth_date" type="date" class="form-control" name="birth_date" required autofocus>
										</div>
									</div>

									<div class="form-group">
										<label for="type" class="col-md-4 control-label">Type</label>
										<div class="col-md-6">
											<select class="form-control" id="type" name="type" required>
												<option value="Doctor">Doctor</option>
												<option value="Nurse">Nurse</option>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="hospital_id" class="col-md-4 control-label">Hospital</label>
										<div class="col-md-6">
											<select class="form-control" id="hospital_id" name="hospital_id" required>
												@foreach ($hospitals as $hospital)
												<option value="{{$hospital->id}}">{{$hospital->hospital_name}}</option>
												@endforeach
											</select>
										</div>
									</div>

								</div>
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">
									Create Account
								</button>
							</div>

						</form>

					</div>

				</div>
			</div>

		</div>
	</div>
</div>
@endsection @section('script') {{--
<script src="{{ asset('/js/datatables/patients.js') }}"></script> --}}
<script>
	$('#tblAccounts').DataTable({
		data: {!!$personnelProfiles!!},
		columns:[
			{data:"first_name",title:"First Name"},
			{data:"last_name",title:"Last Name"},
			{data:"sex",title:"Sex"},
			{data:"birth_date",title:"Birth date"}
		]
	});

</script>
@endsection