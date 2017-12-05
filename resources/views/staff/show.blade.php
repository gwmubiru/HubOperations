@extends('layouts.app')

@if ($staff->type == 1)
	@section('title', 'View Sample Transporter')
@else
	@section('title', 'View Staff Member')
@endif

@section('content')
<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
  <div class="col-xs-12 table-responsive">
    <table class="table">
      <tbody>
      <tr>
          <td>Facility</td>
          <td>@if($staff->facilityid){{ $staff->facility->name }}@endif</td>
        </tr>
        <tr>
          <td>Motor Cycle</td>
          <td>@if($staff->motorbikeid){{ $staff->bike->numberplate }}@endif</td>
        </tr>
        <tr>
          <td>First Name</td>
          <td>{{ $staff->firstname }}</td>
        </tr>
        <tr>
          <td>Last Name</td>
          <td>{{ $staff->lastname }}</td>
        </tr>
         <tr>
          <td>Other Names</td>
          <td>{{ $staff->othernames }}</td>
        </tr>
        <tr>
          <td>Email Address</td>
          <td>{{ $staff->emailaddress }}</td>
        </tr>
        <tr>
          <td>Telephone Number</td>
          <td>{{ $staff->telephonenumber }}</td>
        </tr>
        @if($staff->type == 2)
        <tr>
          <td>Designation</td>
          <td>{{ $staff->designation }}</td>
        </tr>
        @endif
        @if($staff->type == 1)
        <tr>
          <td>Driving Permit</td>
          <td>{{ $staff->drivingpermit }}</td>
        </tr>
        @endif
        <tr>
          <td>National ID</td>
          <td>{{ $staff->nationalid }}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="box-footer clearfix">  
                <a href="{{URL::previous()}}" class="btn btn-sm btn-default pull-left">Back</a>
                <a href="{{route('staff.edit', $staff->id)}}" class="btn btn-sm btn-warning pull-right">Update Sample Transporter</a> </div>
  </div>
</div>
@endsection 