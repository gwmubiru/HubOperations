@extends('layouts.app')
@if ($pagetype == 1)
	@section('title', 'All Sample Transporters')
@elseif($pagetype == 4)
	@section('title', 'All Drivers')
@elseif($pagetype == 2)
	@section('title', 'All Sample Receptionists')
@elseif($pagetype == 5)	
	@section('title', 'All EOC Staff Members ')
@else
@endif

@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@append
@section('listpagejs')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
		$(document).ready(function() {
			$('#stafflisttable').DataTable();
		} );
	</script>
@append
<div class="box box-info">
  
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="stafflisttable" class="table table-striped table-bordered">
    <thead>
    	<tr>
          <th>First Name</th>
          <th>Last Name</th>
          @if($pagetype == 2 || $pagetype == 1 || $pagetype == 3)
          <th>Hub</th>
          @endif
          @if($pagetype == 2)
          <th>Designation</th>
          @endif
          @if($pagetype == 1)
          <th>Has Driving Permit</th>
          <th>Densive Driving</th>
          <th>Trained in BB</th>
          <th>Is Immunised for HB</th>
          @endif
          
          <th>Actions</th>
        </tr>
    </thead>
      <tbody>
        
      @foreach ($staff as $st)
      <tr>
        <td><a href="{{ route('staff.show', $st->id ) }}">{{ $st->firstname }}</a></td>
        <td>{{ $st->lastname }}</td>
         @if($pagetype == 2 || $pagetype == 1 || $pagetype == 3)
        <td>{{ $st->facility }}</td>
        @endif
        @if($pagetype == 2)
        <td>{{ $st->designation }}</td>
        @endif
        @if($pagetype == 1)
        <td>@if($st->hasdrivingpermit){{ getLookupValueDescription('YES_NO', $st->hasdrivingpermit) }} @endif</td>
        <td>@if($st->hasdefensiveriding){{ getLookupValueDescription('YES_NO', $st->hasdefensiveriding) }} @endif</td>
        <td>@if($st->hasbbtraining){{ getLookupValueDescription('YES_NO', $st->hasbbtraining) }} @endif</td>
        <td>@if($st->isimmunizedforhb){{ getLookupValueDescription('YES_NO', $st->isimmunizedforhb) }} @endif</td>
        @endif

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