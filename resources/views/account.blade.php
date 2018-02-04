@extends('layouts.app') 
@section('pageTitle')
Personnel Profile
@endsection
@section('content')

<div class="container-fluid">
    <h3>{{ $account->type ." ". $account->first_name ." ". $account->last_name }}</h3>
	<div class="row">
        <div class="col-md-4">
            <image src="/{{'storage/'.$account->image_location}}" class="displaypic">
        </div>
		<div class="col-md-8">
            <h3><small>First Name: </small>{{ $account->first_name }} &nbsp;&nbsp; <small>Last Name: </small>{{ $account->last_name }}</h3>
            <h3><small>Sex: </small> {{ $account->sex }} &nbsp;&nbsp; <small>Date of birth: </small>{{ $account->birth_date }}</h3>
            <h3><small>Hospital: </small>{{ App\Hospital::where('id',$account->hospital_id)->first()->hospital_name }}</h3>
            <h3><small>Contact number: </small>{{$account->contact_number }}</h3>
            <h3><small>Email address: </small>{{$account->email }}</h3>
		</div>
    </div>    
</div>


@endsection

