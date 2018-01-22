@extends('layouts.app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">New Hospital</button>
					<h3>Hospitals List</h3>
				</div>


				<div class="panel-body">
					<table id="tblHospitals" class=" table table-hover display" cellspacing="0" width="100%">
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
							<h4 class="modal-title">Hospital</h4>
						</div>
						<form class="form-horizontal" method="POST" action="">
							<div class="modal-body">

								<div class="panel-body">

									{{ csrf_field() }}

									<div class="form-group">
										<label for="hospital_name" class="col-md-4 control-label">Hospital Name</label>
										<div class="col-md-6">
											<input id="hospital_name" type="text" class="form-control" name="hospital_name" required autofocus>
										</div>
									</div>

									<div class="form-group">
										<label for="address" class="col-md-4 control-label">Address</label>
										<div class="col-md-6">
											<input id="address" type="text" class="form-control" name="address" required>
										</div>
									</div>

									<div class="form-group">
										<label for="type" class="col-md-4 control-label">Type</label>
										<div class="col-md-6">
											<select class="form-control" id="type" name="type" required>
												<option value="Hospital">Hospital</option>
												<option value="Clinic">Clinic</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">
									Add Hospital
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
	$('#tblHospitals').DataTable({
		data: {!!$hospitals!!},
		columns:[
			{data:"id",title:"ID"},
			{data:"hospital_name",title:"Hospital Name"},
			{data:"address",title:"Address"},
			{data:"type",title:"Type"}
		]
	});

</script>
@endsection