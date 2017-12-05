@extends('layouts.app')

@section('title', 'View Bike List')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@append
@section('js')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script> 
<script>
$(document).ready(function() {
	$('#listtable').DataTable();
} );
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
    
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-hover dataTable" id="listtable">
    <thead>
    	<tr>
          <th>Number Plate</th>
          <th>Engine Number</th>
          <th>Year of Manufacture</th>
          @role('Admin','Program_officer') <th>Actions</th> @endrole
        </tr>
    </thead>
      <tbody>
        
      @foreach ($equipment as $eq)
      <tr class="bikestate{{$eq->status}}">
        
        <td><a href="{{ route('equipment.show', $eq->id ) }}">{{ $eq->numberplate }}</a></td>
        <td>{{ $eq->enginenumber }}</td>
        <td>{{ $eq->yearofmanufacture }}</td>
        @role('Admin','Program_officer')<td><a href="{{ route('equipment.edit', $eq->id ) }}"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="{{ route('equipment.destroy', $eq->id ) }}"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
        </td>@endrole
      </tr>
      @endforeach
        </tbody>
    </table>
  </div>
  <!-- /.box-body -->
  
</div>
@endsection