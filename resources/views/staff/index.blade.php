@extends('layouts.app')
@if ($pagetype == 1)
	@section('title', 'View All Sample Transporters')
@else
	@section('title', 'View All Staff Members')
@endif

@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@append
@section('listpagejs')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
		$(document).ready(function() {
			$('#listtable').DataTable();
		} );
	</script>
@append
<div class="box box-info">
  
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="listtable" class="table table-striped table-bordered">
    <thead>
    	<tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Hub</th>
          @if($pagetype == 2)
          <th>Designation</th>
          @endif
          @if($pagetype == 1)
          <th>Driving Permit</th>
          @endif
          <th>National ID</th>
          <th>Actions</th>
        </tr>
    </thead>
      <tbody>
        
      @foreach ($staff as $st)
      <tr>
        <td><a href="{{ route('staff.show', $st->id ) }}">{{ $st->firstname }}</a></td>
        <td>{{ $st->lastname }}</td>
        <td>{{ $st->facility }}</td>
        @if($pagetype == 2)
        <td>{{ $st->designation }}</td>
        @endif
        @if($pagetype == 1)
        <td>{{ $st->drivingpermit }}</td>
        @endif
        <td>{{ $st->nationalid }}</td>
        <td><a href="{{ route('staff.edit', $st->id ) }}"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="{{ route('staff.destroy', $st->id ) }}"><i class=" fa fa-fw fa-trash-o"></i>Delete</a>
        </td>
      </tr>
      @endforeach
        </tbody>
    </table>
  </div>
  <!-- /.box-body -->
  
</div>
@endsection