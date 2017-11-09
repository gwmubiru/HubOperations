@extends('layouts.app')

@section('title', 'View Bike List')
@section('js')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script>
 $('select').select2({
        allowClear: false,
        minimumResultsForSearch: -1,
        placeholder: function(){
            $(this).data('placeholder');
        }
    });
</script>
@append
@section('content')
<style>
	div.dataTables_length label {
    font-weight: normal;
    float: left;
    text-align: left;
    margin-bottom: 0;
}
div.dataTables_length select {
    min-width: 60px;
    margin-right: 4px;
}
</style>
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
    <table class="table table-hover dataTable" id="equipmentid">
      <tbody>
        <tr>
          @role('Admin','Program_officer') <th>Actions</th> @endrole
          <th>Number Plate</th>
          <th>Engine Number</th>
          <th>Year of Manufacture</th>
        </tr>
      @foreach ($equipment as $eq)
      <tr>
        @role('Admin','Program_officer')<td><a href="{{ route('equipment.edit', $eq->id ) }}"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="{{ route('equipment.destroy', $eq->id ) }}"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
        </td>@endrole
        <td><a href="{{ route('equipment.show', $eq->id ) }}">{{ $eq->numberplate }}</a></td>
        <td>{{ $eq->enginenumber }}</td>
        <td>{{ $eq->yearofmanufacture }}</td>
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
        {!! $equipment->links() !!}
          
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection