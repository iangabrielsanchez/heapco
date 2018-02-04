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
			<div class='container'></div>
			<h4>Comments:</h4>
			@foreach($comments as $comment)
			<a href="/accounts/{{$post->personnel_id}}">{{$comment->personnel_first_name}} {{$comment->personnel_last_name}}</a> at {{$comment->created_at}}</p>
			{{$comment->comment}}
			<hr/> @endforeach
			<form class="form-horizontal" method="POST" action="/comments">
				{{ csrf_field() }}
				<h4>Add comment:</h4>
				<input type="hidden" name="post_id" value="{{$post->id}}">
				<input type="hidden" name="doctor_id" value="{{session('accountID')}}">
				<div class="form-group">
					<div class="col-md-8">
						<textarea id="comment" class="form-control" name="comment" rows="5" required autofocus></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">
					Comment
				</button>
			</form>
		</div>

	</div>
</div>
</div>
@endsection