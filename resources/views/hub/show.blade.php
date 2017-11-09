@extends('layouts.app')

@section('title', 'View Hub')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@append
@section('listpagejs')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
		$(document).ready(function() {
			$('#facilitylist').DataTable();
		} );
	</script>
@append
@section('content')
<div class="box tabbed-view">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
  	<div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Hub Details</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Facilities Served</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Techinical Team</a></li>
        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Routing Schedule</a></li>
        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="col-xs-12 table-responsive">
    <table class="table">
      <tbody>
      <tr>
          <td>Name</td>
          <td>{{ $hub->name }}</td>
        </tr>
        <tr>
          <td>IP</td>
          <td>@if($hub->ipid){{ $hub->ip->name }}@endif</td>
        </tr>
      	<tr>
          <td>Health Region</td>
          <td>@if($hub->ipid){{ $hub->ip->healthregion->name }}@endif</td>
        </tr>
         <tr>
          <td>Code</td>
          <td>@if($hub->code){{ $hub->code }}@endif</td>
        </tr>
        <tr>
          <td>Address</td>
          <td>{{ $hub->address }}</td>
        </tr>        
      </tbody>
    </table>
    </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
        	<div class="box-body table-responsive">
    <table id="facilitylist" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Actions</th>
          <th>Name</th>
          <th>District</th>
          <th>Level</th>
        </tr></thead>
        <tbody>
      @foreach ($facilities as $facility)
      <tr>
        <td><a href="{{ route('facility.edit', $facility->id ) }}"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="{{ route('facility.edit', $facility->id ) }}"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
        </td>
        <td><a href="{{ route('facility.show', $facility->id ) }}">{{ $facility->name }}</a></td>
        <td>{{ $facility->district }}</td>
        <td>{{ $facility->facilitylevel }}</td>
      </tr>
      @endforeach
        </tbody>
    </table>
  </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">In-Charge</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  @if($incharge)
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td>{{$incharge->firstname.' '.$incharge->lastname.' '.$incharge->othernames}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td>{{$incharge->telephonenumber}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td>{{$incharge->emailaddress}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                     @else
                    <p class="no-contact">You do not have any in-charge contact. Please click the button below to to add one.</p>
                    @endif
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> @if(!$incharge)<a href="{{url('contact/new/category/2/type/1/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a>@else 
                <a href="{{url('contact/new/category/2/type/1/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="{{route('contact.edit', $incharge->id)}}" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> @endif</div>
                <!-- /.box-footer --> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Hub Cordinator</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  @if($hubcordinator)
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td>{{$hubcordinator->firstname.' '.$hubcordinator->lastname.' '.$hubcordinator->othernames}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td>{{$hubcordinator->telephonenumber}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td>{{$hubcordinator->emailaddress}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                    @else
                    <p class="no-contact">You do not have any hub coordinator contact. Please click the button below to to add one.</p>
                    @endif
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> @if(!$hubcordinator)<a href="{{url('contact/new/category/2/type/2/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a>@else 
                <a href="{{url('contact/new/category/2/type/2/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="{{route('contact.edit', $hubcordinator->id)}}" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> @endif</div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
          <div class="row mid-row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Lab Manager</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  @if($labmanager)
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td>{{$labmanager->firstname.' '.$labmanager->lastname.' '.$labmanager->othernames}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td>{{$labmanager->telephonenumber}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td>{{$labmanager->emailaddress}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                     @else
                    <p class="no-contact">You do not have any lab manager contact. Please click the button below to to add one.</p>
                    @endif
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> @if(!$labmanager)<a href="{{url('contact/new/category/2/type/3/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a>@else 
                <a href="{{url('contact/new/category/2/type/3/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="{{route('contact.edit', $labmanager->id)}}" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> @endif</div>
                <!-- /.box-footer --> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">VL Focal Person</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  @if($vlfocalperson)
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td>{{$vlfocalperson->firstname.' '.$vlfocalperson->lastname.' '.$vlfocalperson->othernames}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td>{{$vlfocalperson->telephonenumber}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td>{{$vlfocalperson->emailaddress}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                     @else
                    <p class="no-contact">You do not have any VL focal person contact. Please click the button below to to add one.</p>
                    @endif
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> @if(!$vlfocalperson)<a href="{{url('contact/new/category/2/type/4/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a>@else 
                <a href="{{url('contact/new/category/2/type/4/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="{{route('contact.edit', $labmanager->id)}}" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> @endif</div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
          <div class="row mid-row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">EID Focal Person</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  @if($eidfocalperson)
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td>{{$eidfocalperson->firstname.' '.$eidfocalperson->lastname.' '.$eidfocalperson->othernames}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td>{{$eidfocalperson->telephonenumber}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td>{{$eidfocalperson->emailaddress}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                     @else
                    <p class="no-contact">You do not have any lab EID focal person. Please click the button below to to add one.</p>
                    @endif
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> @if(!$eidfocalperson)<a href="{{url('contact/new/category/2/type/5/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a>@else 
                <a href="{{url('contact/new/category/2/type/5/obj', ['obj' => $hub->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="{{route('contact.edit', $labmanager->id)}}" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> @endif</div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
  <div class="col-xs-12 table-responsive">
   @if(count($mondayschedule) || count($tuesdayschedule) || count($wednesdayschedule) || count($thursdayschedule) || count($fridayschedule) || count($saturdayschedule) || count($sundayschedule))
   @if(count($mondayschedule)) 
   <table class="table table-bordered">
    
    	<thead>
        	<td>Monday</td>
            <td>Tuesday</td>
            <td>Wednesday</td>
            <td>Thursday</td>
            <td>Friday</td>
            <td>Saturday</td>
            <td>Sunday</td>
        </thead>
      <tbody>
      <tr>
          <td>
          		<ul class="nav nav-pills nav-stacked">
                @foreach($mondayschedule as $schedule)
                    <li>{{$schedule->facility->name}}</li>
                @endforeach
                </ul>
          	@endif
          </td>
          <td>@if(count($tuesdayschedule))
          		<ul class="nav nav-pills nav-stacked">
                @foreach($tuesdayschedule as $schedule)
                    <li>{{$schedule->facility->name}}</li>
                @endforeach
                </ul>
          	@endif
          </td>
          <td>@if(count($wednesdayschedule))
          		<ul class="nav nav-pills nav-stacked">
                @foreach($wednesdayschedule as $schedule)
                    <li>{{$schedule->facility->name}}</li>
                @endforeach
                </ul>
          	@endif
          </td>
          <td>@if(count($thursdayschedule))
          		<ul class="nav nav-pills nav-stacked">
                @foreach($thursdayschedule as $schedule)
                    <li>{{$schedule->facility->name}}</li>
                @endforeach
                </ul>
          	@endif
          </td>
          <td>@if(count($fridayschedule))
          		<ul class="nav nav-pills nav-stacked">
                @foreach($fridayschedule as $schedule)
                    <li>{{$schedule->facility->name}}</li>
                @endforeach
                </ul>
          	@endif
          </td>
          <td>@if(count($saturdayschedule))
          		<ul class="nav nav-pills nav-stacked">
                @foreach($saturdayschedule as $schedule)
                    <li>{{$schedule->facility->name}}</li>
                @endforeach
                </ul>
          	@endif
          </td>
          <td>@if(count($sundayschedule))
          		<ul class="nav nav-pills nav-stacked">
                @foreach($sundayschedule as $schedule)
                    <li>{{$schedule->facility->name}}</li>
                @endforeach
                </ul>
          	@endif
          </td>
        </tr>
        
      </tbody>
    </table>
    @else
   <p>This hub has not yet added their routing schedule. Follow-up with them, or create for them one by clickin of the "Create Schedule" button below.
    @endif
    </div>
  </div>
   <div class="box-footer"> 
  @if(count($mondayschedule) || count($tuesdayschedule) || count($wednesdayschedule) || count($thursdayschedule) || count($fridayschedule) || count($saturdayschedule) || count($sundayschedule))
  
  @else
   <a class="btn btn-primary pull-right" href="{{ route('routingschedule.create') }}">Create Schedule</a>
  @endif
  </div>
</div>
              
            </div>
          </div>
          
        </div> 
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content --> 
    </div>
  </div>
</div>
@endsection 