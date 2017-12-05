@extends('layouts.app')

@section('title', 'View Facility')

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
          <td>Name</td>
          <td>{{ $facility->name }}</td>
        </tr>
        <tr>
          <td>District</td>
          <td>{{ $facility->district->name}}</td>
        </tr>
        <tr>
          <td>Hub</td>
          <td>{{ $facility->hub->name}}</td>
        </tr>
        <tr>
          <td>Level</td>
          <td>{{ $facility->facilitylevel->level }}</td>
        </tr>
        <tr>
          <td>Contact Person</td>
          <td>{{ $facility->contactperson }}</td>
        </tr>
        <tr>
          <td>Email Address</td>
          <td>{{ $facility->email }}</td>
        </tr>
        <tr>
          <td>Physical Address</td>
          <td>{{ $facility->address }}</td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="box-footer clearfix">  
                <a href="{{URL::previous()}}" class="btn btn-sm btn-default pull-left">Back</a>
                <a href="{{route('facility.edit', $facility->id)}}" class="btn btn-sm btn-warning pull-right">Update Facility</a> </div>
  </div>
</div>
@endsection 