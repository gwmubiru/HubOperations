@extends('layouts.app')
@section('title', 'View All Hubs')
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
          <th>Name</th>
          <th>Health Region</th>
          <th>Address</th>
         
        </tr>
      @foreach ($hubs as $hub)
      <tr>
        <td><a href="{{ route('hub.edit', $hub->id ) }}"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="{{ route('hub.destroy', $hub->id ) }}"><i class=" fa fa-fw fa-trash-o"></i>Delete</a>
        </td>
        <td><a href="{{ route('hub.show', $hub->id ) }}">{{ $hub->hubname }}</a></td>
        <td>@if($hub->healthregionid){{ $hub->healthregion->name }}@endif</td>
        <td>{{ $hub->address }}</td>
        
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
        {!! $hubs->links() !!}
          
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection