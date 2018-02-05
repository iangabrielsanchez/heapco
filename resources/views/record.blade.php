@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">


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
			<hr>
		</div>

	</div>
</div>
</div>
@endsection