@extends('layouts.app')
@if ($pagetype == 1)
	@section('title', 'View All Sample Transporters')
@else
	@section('title', 'View All Staff Members')
@endif

@section('content')

<div class="box box-info">
  <div class="box-header">
    <div class="dataTables_length" id="facility_length">
      <label>Show
        <select name="facility_length" aria-controls="facility" class="form-control input-sm">
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        entries</label>
    </div>
    <div class="box-tools">
      <div class="input-group input-group-sm" style="width: 150px;">
        <input name="table_search" class="form-control pull-right" placeholder="Search" type="text">
        <div class="input-group-btn">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-hover">
      <tbody>
        <tr>
          <th>Actions</th>
          <th>Facility</th>
          <th>First Name</th>
          <th>Last Name</th>
          @if($pagetype == 2)
          <th>Designation</th>
          @endif
          @if($pagetype == 1)
          <th>Driving Permit</th>
          @endif
          <th>National ID</th>
        </tr>
      @foreach ($staff as $st)
      <tr>
        <td><a href="{{ route('staff.edit', $st->id ) }}"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="{{ route('staff.destroy', $st->id ) }}"><i class=" fa fa-fw fa-trash-o"></i>Delete</a>
        </td>
        <td><a href="{{ route('staff.show', $st->id ) }}">{{ $st->facility->name }}</a></td>
        <td>{{ $st->firstname }}</td>
        <td>{{ $st->lastname }}</td>
        @if($pagetype == 2)
        <td>{{ $st->designation }}</td>
        @endif
        @if($pagetype == 1)
        <td>{{ $st->drivingpermit }}</td>
        @endif
        <td>{{ $st->nationalid }}</td>
      </tr>
      @endforeach
        </tbody>
    </table>
  </div>
  <!-- /.box-body -->
  <div class="box-footer clearfix">
    <div class="row">
      <div class="col-md-5 col-sm-12"> Showing 1 to 1 of 1 entries </div>
      <div class="col-md-7 col-sm-12">
        <ul class="pagination pagination-sm no-margin pull-right">
        {!! $staff->links() !!}
          
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection