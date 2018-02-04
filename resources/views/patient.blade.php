@extends('layouts.app') 
@section('pageTitle')
Patient Profile
@endsection
@section('content')

<div class="container-fluid">
    <h3>{{ $patient->first_name ." ". $patient->last_name }}</h3>
	<div class="row">
        <div class="col-md-4">
            <image src="{{'https://s3-ap-southeast-1.amazonaws.com/hau-heapco/files/'.$patient->image_location}}" class="displaypic">
        </div>
		<div class="col-md-8">
            <h3><small>First Name: </small>{{ $patient->first_name }} &nbsp;&nbsp; <small>Last Name: </small>{{ $patient->last_name }}</h3>
            <h3><small>Sex: </small> {{ $patient->sex }} &nbsp;&nbsp; <small>Date of birth: </small>{{ $patient->birth_date }}</h3>
            <h3><small>Address: </small>{{$patient->address }}</h3>
            <h3><small>Contact number: </small>{{$patient->contact_number }}</h3>
            <h3><small>Email address: </small>{{$patient->email }}</h3>
		</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4">     
            <h3>Files 
                @if( session("accountType") != "patient")
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Upload File</button>
                @endif
            </h3>
            <div class="well">
            @foreach($files as $file)
                <a href="https://s3-ap-southeast-1.amazonaws.com/hau-heapco/files/{{$file->path}}">
                    <h4>
                        {{$file->title}}<br/>
                        <small>{{$file->description}}</small>
                    </h4>
                </a>
                <?php $uploader = App\PersonnelProfile::where('id',$file->personnel_id)->first();?>
                <p>Uploaded by: {{$uploader->type . " ". $uploader->first_name . " " . $uploader->last_name}}</p>
                <hr>
            @endforeach
            </div>
        </div>
        @if( session("accountType")=="doctor")
        <div class="col-md-8">
            <h3>Posts <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">New Post</button></h3>
            <div class="well">
            @foreach ($posts as $post)
                <h4>
                    <a href='/forums/{{$post->id}}'>{{$post->topic}}</a>
                    <small>
                        <p class="text-muted">By
                            <a href="/accounts/{{$post->personnel_id}}">{{$post->personnel_first_name}} {{$post->personnel_last_name}}</a> at {{$post->created_at}}</p>
                    </small>
                </h4>
                {{--  <p>{{$post->content}}</p>  --}}
                <hr> 
            @endforeach
            </div>
        </div>
        @endif
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
            <form class="form-horizontal" method="POST" action="/fileUpload" enctype="multipart/form-data">
                <div class="modal-body">
                    
                    <div class="panel-body">
                        
                        {{ csrf_field() }}
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        
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
