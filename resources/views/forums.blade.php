@extends('layouts.app') @section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">New Post</button>
					<h3>Posts List</h3>
				</div>

				{{-- {{dd($posts)}} --}}

				<div class="panel-body">
					@foreach ($posts as $post)

					<h4>
						<a href='/forums/{{$post->id}}'>{{$post->topic}}</a>
						<small>
							(Case of
							<a href="/patients/{{$post->patient_id}}">{{$post->patient_first_name}} {{$post->patient_last_name}}</a>)
							<p class="text-muted">By
								<a href="/accounts/{{$post->personnel_id}}">{{$post->personnel_first_name}} {{$post->personnel_last_name}}</a> at {{$post->created_at}}</p>
						</small>
					</h4>
					<p>{{$post->content}}</p>
					<hr> @endforeach

				</div>

			</div>

			<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">New Post</h4>
						</div>
						<form class="form-horizontal" method="POST" action="">
							<div class="modal-body">

								<div class="panel-body">

									{{ csrf_field() }}

									<div class="form-group">
										<label for="patient_id" class="col-md-4 control-label">Patient</label>
										<div class="col-md-6">
											<select class="form-control" id="patient_id" name="patient_id" required>
												@foreach ($patients as $patient)
												<option value="{{$patient->id}}">{{$patient->first_name}} {{$patient ->last_name}}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="topic" class="col-md-4 control-label">Topic</label>
										<div class="col-md-6">
											<input id="topic" type="text" class="form-control" name="topic" required autofocus>
										</div>
									</div>


									<div class="form-group">
										<label for="content" class="col-md-4 control-label">Content</label>
										<div class="col-md-6">
											<textarea id="content" class="form-control" name="content" rows="10" required autofocus></textarea></textarea>
										</div>
									</div>

									<input type="hidden" name="doctor_id" value="{{session('accountID')}}">



								</div>
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">
									Post
								</button>
							</div>

						</form>

					</div>

				</div>
			</div>

		</div>
	</div>
</div>
@endsection