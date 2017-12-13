@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Personnel Profile</div>
				<div class="panel-body">

					<p>
						<b>Email: </b>{{$account->email}}
					</p>

					<p>
						<b>Password: </b>{{$account->password}}
					</p>

					<p>
						<b>Type: </b>{{$account->type}}
					</p>

					<p>
						<b>First Name: </b>{{$account->first_name}}
					</p>

					<p>
						<b>Last Name: </b>{{$account->last_name}}
					</p>

					<p>
						<b>Sex: </b>{{$account->sex}}
					</p>

					<p>
						<b>Birth Date: </b>{{$account->birth_date}}
					</p>

					<p>
						<b>Hospital: </b>{{$account->hospital_id}}
					</p>

					<p>
						<b>Contact Number: </b>{{$account->contact_number}}
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection