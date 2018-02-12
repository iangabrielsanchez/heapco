@extends('layouts.app')
@section('styles')

@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                @if(session('accountType') === 'doctor')
                <p>{{session('accountType')}}</p>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">New Appointment</button>
                @endif
                    <h4>Dashboard</h4>
                </div>
                <div class="panel-body">
                    {!! $calendar->calendar()!!}
                    {!! $calendar->script()!!}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Appointment</h4>
            </div>
            <form class="form-horizontal" method="POST" action="/appointments">
                <div class="modal-body">

                    <div class="panel-body">

                        {{ csrf_field() }}
                        <input type="hidden" name="doctor_id" value="{{session('accountID')}}">
                        <div class="form-group">
                            <label for="event" class="col-md-4 control-label">Appointment Title</label>
                            <div class="col-md-6">
                                <input id="event" type="text" class="form-control" name="event" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event" class="col-md-4 control-label">Start Time</label>
                            <div class="col-md-6">
                                <input id="startTime" type="datetime-local" class="form-control" value="{{date('Y-m-d\TH:i')}}" name="startTime" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="event" class="col-md-4 control-label">End Time</label>
                            <div class="col-md-6">
                                <input id="endTime" type="datetime-local" class="form-control" value="{{date('Y-m-d\TH:i')}}" name="endTime" required autofocus>
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
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css">
{!! $calendar->calendar()!!}
{!! $calendar->script()!!}

@endsection

