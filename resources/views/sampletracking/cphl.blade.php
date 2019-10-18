@extends('layouts.app')
@section('title', 'Samples')
@section('content')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" />
@append
@section('listpagejs') 
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.colVis.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#listtable').DataTable( {
				dom: 'Bflrtip',
				buttons: [
					
					{
						extend: 'excelHtml5',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'pdfHtml5',
						exportOptions: {
							columns: ':visible'
						}
					},
					'colvis'
				]
			} );
		$('.filter-date').datepicker({
		   format: 'mm/dd/yyyy',
		   endDate: '+0d',
		   autoclose: true
		});
		
		$(".sample").click(function(){
			var sampleid = $(this).attr('id');
			$('#samplemodal_' + sampleid).modal('show');
		});
				
	} );
	
</script> 
@append
<style>
	#searchbutton{
		margin-top: -4px;
	}
	.input-field{
		width:100px;
	}
	.selectdropdown{
		width:200px;
	}
	.input-field, .selectdropdown {
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
        border-top-color: rgb(204, 204, 204);
        border-right-color: rgb(204, 204, 204);
        border-bottom-color: rgb(204, 204, 204);
        border-left-color: rgb(204, 204, 204);
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
</style>
<div class="box box-info">
<div class="well firstrow list">
  <div class="row">
    {{ Form::open(array('route' => 'samples.cphl', 'class' => 'form-search pull-left', 'id' => 'samplelist')) }}
            {{ csrf_field() }}
   {{ Form::text('from', old('from'), ['class' => 'input-field filter-date', 'id' => 'from', 'placeholder' => 'From']) }}
   {{ Form::text('to', old('to'), ['class' => 'input-field filter-date', 'id' => 'to', 'placeholder' => 'To']) }}
   {{Form::select('status', $status_dropdown, old('status'), ['class'=>'selectdropdown autosubmitsearchform'])}}
   
@role(['national_hub_coordinator','administrator']) 
    {{Form::select('hubid', $hubs, old('hubid'), ['class'=>'selectdropdown autosubmitsearchform'])}}
    @endrole
   @role(['national_hub_coordinator','administrator'])  
   @endrole
    
   	<button type="submit" id="searchbutton" class="btn btn-primary">Filter <i class="glyphicon glyphicon-filter"></i></button>
    {{ Form::close() }}
   
  </div>
  
</div>
  
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="listtable" class="table table-striped table-bordered">
      <thead>
        <tr>
            <th>Envelope ID</th>
            <th>No.Envelopes</th>
          <th>From</th>
          <th>Picked on</th>
          <th>Status</th>
          <th>Received at</th>
          @role(['hub_coordinator','cphl_sample_reception'])
          <th>Action</th>
          @endrole
        </tr>
      </thead>
      <tbody>      
      @foreach ($samples as $sample)
      <tr>
      <td>{{$sample->barcode}}</td>
      <td>{{$sample->numberofenvelopes}}</td>
        <td>{{$sample->hubname}}</td>
        <td>{{getPageDateFormat($sample->thedate)}}</td>
        <td> @if($sample->status == 1)
        In transit to CPHL
        @elseif($sample->status == 2)
        Delivered to CPHL
        @elseif($sample->status == 3)
        Received at CPHL
        @else
       Waiting Pickup 
        @endif</td>
        <td>@if($sample->recieved_at != '')
        {{$sample->recieved_at}}
        @else
        {{$sample->delivered_at}}
        @endif</td>
        @role(['hub_coordinator','cphl_sample_reception'])
        <td>    
        @role(['cphl_sample_reception'])
        @if($sample->status < 3)
        <a href="{{ route('sampletracking.receivesample',$sample->id) }}">Receive</a>
        @endif
        @endrole
        </td>
        @endrole
      </tr>
      @endforeach
        </tbody>      
    </table>
  </div>
  <!-- /.box-body --> 
</div>
@endsection