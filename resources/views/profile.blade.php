@extends('layouts.app') 
@section('pageTitle')
{{ Auth::user()->name }}
@endsection
@section('content')
<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
            <pre>{{Auth::user()}}</pre>
		</div>
	</div>
</div>
@endsection