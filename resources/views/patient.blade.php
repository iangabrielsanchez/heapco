@extends('layouts.app') 
@section('pageTitle')
Patient Profile
@endsection
@section('content')

<div class="container-fluid">
    <h3>{{ $patient->first_name ." ".$patient->middle_name." ". $patient->last_name }}</h3>
	<div class="row">
        <div class="col-md-4">
            <image src="{{'https://s3-ap-southeast-1.amazonaws.com/hau-heapco/'.$patient->image_location}}" class="displaypic">
        </div>
		<div class="col-md-8">
            <h3><small>First Name: </small>{{ $patient->first_name }} &nbsp;&nbsp;<small>Middle Name:</small>{{$patient->middle_name}} <small>Last Name: </small>{{ $patient->last_name }}</h3>
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
            <?php $uploader = App\PersonnelProfile::where('id',$file->personnel_id)->first();?>
            <?php $user = App\PersonnelProfile::find(session('accountID')); ?>
            @if($file->status == 'enabled')
                <h4>
                    @if(
                        ($uploader->type . " ". $uploader->first_name . " " . $uploader->last_name) == 
                        ($user->type . " ". $user->first_name . " " . $user->last_name)
                    )
                    <a href="/files/{{$file->id}}/toggle"><i class="fa fa-unlock"></i></a>
                    @endif
                    <a href="https://s3-ap-southeast-1.amazonaws.com/hau-heapco/{{$file->path}}">
                        
                        {{$file->title}}<br/>
                        <small>{{$file->description}}</small>
                    </a>
                </h4>
                @else
                <h4>
                    <p>
                        @if(
                            ($uploader->type . " ". $uploader->first_name . " " . $uploader->last_name) == 
                            ($user->type . " ". $user->first_name . " " . $user->last_name)
                        )
                        <a href="/files/{{$file->id}}/toggle"><i class="fa fa-lock"></i></a>
                        @endif
                        {{$file->title}}<br/>
                        <small>{{$file->description}}</small>
                    </p>
                </h4>
                @endif
                <p>Uploaded by: {{$uploader->type . " ". $uploader->first_name . " " . $uploader->last_name}}</p>
                <hr>
            @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <h3>Records 
                @if( session("accountType") != "patient")
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#newRecord">New Record</button>
                @endif
            </h3>
            <div class="well">
                @foreach ($records as $record)
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse{{$record->id}}">{{$record->type}}: {{$record->title}}<small> at {{$record->created_at}}</small></a>
                            </h4>
                        </div>
                        <div id="collapse{{$record->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            @if (\App\Http\Controllers\PatientsController::endsWith($record->file_location, [".jpg",".jpeg",".gif",".png",".bmp"]))
                            <a href="https://s3-ap-southeast-1.amazonaws.com/hau-heapco/{{$record->file_location}}"><i class="fa fa-paperclip"></i>Post attachments
                            <img src="https://s3-ap-southeast-1.amazonaws.com/hau-heapco/{{$record->file_location}}" width="100%"></a>
                            <hr/>
                            @elseif ($record->file_location)
                            <a href="https://s3-ap-southeast-1.amazonaws.com/hau-heapco/{{$record->file_location}}"><i class="fa fa-paperclip"></i> Post attachment</a>
                            <hr/>
                            @endif
                            {{$record->records}}
                        </div>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>

        @if( session("accountType")=="doctor")
        <div class="col-md-4">
            <h3>Posts <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addPost">New Post</button></h3>
            <div class="well">
            @foreach ($posts as $post)
                <h4>
                    <a href='/forums/{{$post->id}}'>{{$post->topic}}</a>
                    @if($post->status == "closed")
                    (closed)
                    @endif
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
<div id="addPost" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Post</h4>
            </div>
            <form class="form-horizontal" method="POST" action="/forums" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="panel-body">

                        {{ csrf_field() }}
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="doctor_id" value="{{session('accountID')}}">
                        <input type="hidden" name="status" value="open">
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

                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">File</label>
                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="file" accept="image/*,.pdf,.doc,.docx,.rtf,.txt" autofocus>
                            </div>
                        </div>

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

<!-- Modal -->
<div id="newRecord" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Record</h4>
            </div>
            <form class="form-horizontal" method="POST" action="/records" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="panel-body">

                        {{ csrf_field() }}
                        <input type="hidden" name="patient_id" value="{{$patient->id}}">
                        <input type="hidden" name="doctor_id" value="{{session('accountID')}}">
                        <div class="form-group">
                            <label for="record_type" class="col-md-4 control-label">Record Type</label>
                            <div class="col-md-6">
                                <select class="form-control" id="record_type" name="record_type" required>
                                    <option value="Diagnosis">Diagnosis</option>
                                    <option value="Results">Lab Test Results</option>
                                    <option value="Vital Signs">Vital Signs</option>
                                    <option value="Medications">Medications</option>
                                    <option value="Surgeries">Surgeries</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="records" class="col-md-4 control-label">Records</label>
                            <div class="col-md-6">
                                <textarea id="records" class="form-control" name="records" rows="10" required autofocus></textarea></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">Attachment</label>
                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control" name="file" accept="image/*,.pdf,.doc,.docx,.rtf,.txt" autofocus>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        Add Record
                    </button>
                </div>

            </form>

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

                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Visibility</label>
                            <div class="col-md-6">
                                <select class="form-control" id="status" name="status" required>
                                    <option value="enabled">Public</option>
                                    <option value="disabled">Only Me</option>
                                </select>
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
