@extends('layouts.app') 
@section('pageTitle')
Personnel Profile
@endsection
@section('content')

<div class="container-fluid">
    <h3>{{ $patient->first_name ." ". $patient->last_name }}</h3>
	<div class="row">
        <div class="col-md-4">
            <image src="/{{'storage/'.$patient->image_location}}" class="displaypic">
        </div>
		<div class="col-md-8">
            <h3><small>First Name: </small>{{ $patient->first_name }} &nbsp;&nbsp; <small>Last Name: </small>{{ $patient->last_name }}</h3>
            <h3><small>Sex: </small> {{ $patient->sex }} &nbsp;&nbsp; <small>Date of birth: </small>{{ $patient->birth_date }}</h3>
            <h3><small>Address: </small>{{$patient->address }}</h3>
            <h3><small>Contact number: </small>{{$patient->contact_number }}</h3>
            <h3><small>Email address: </small>{{$patient->email }}</h3>
		</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
            <h3>Files <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Upload File</button></h3>
            
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload New Patient Document</h4>
            </div>
            <form class="form-horizontal" method="POST" action="/fileupload" enctype="multipart/form-data">
                <div class="modal-body">
                    
                    <div class="panel-body">
                        
                        {{ csrf_field() }}
                        
                        
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">File</label>
                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="file" accept="image/*,.pdf,.doc,.docx,.rtf,.txt" required autofocus>
                            </div>
                        </div>
                        

                    </div>

                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Upload
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>


@endsection

