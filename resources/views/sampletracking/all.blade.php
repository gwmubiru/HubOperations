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
			
    var table = $('#listtable').DataTable();
    $('#listtable').on('search.dt', function() {
        var value = $('.dataTables_filter input').val();
        //console.log(value); // <-- the value
    }); 

    $('.dataTables_filter input').unbind().keyup(function() {
        var value = $(this).val();
        //only start to search if string is at least 12 characters
        if (value.length>12) {
            table.search(value).draw();
            var info = table.page.info();
            //var rowstot = info.recordsTotal;
            //alert("rowstot: " + rowstot);
            var rowsshown = info.recordsDisplay;
          if(rowsshown == 0){
            //use record details of the unscanned barcode
            //alert('no results');
            $('#barcode').val(value);
            $('#no_barcode').modal('show');
          }
        } 

        if (value.length==0) table.search('').draw();

    });

    //on selecting a hub, get the facilities it serves
    $("select[name='hubid']").change(function(){
      var hubid = $(this).val();
      var hiddenvalue = $("input[name='_token']").val();
      
      $.ajax({
        url: "<?php echo url('dailyrouting/facilitiesforhub'); ?>",
        method: 'POST',
        data: {hubid:hubid, _token:hiddenvalue},
        success: function(data) {
            $("select[name='facilityid'").empty();
          $("select[name='facilityid'").html(data.options);
          }
        });
      });

      $('.rec_sample').click(function(event){
          event.preventDefault();
          $('#no_samples #the_id').val(event.target.id);
          $('#no_samples').modal('show');
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
    {{ Form::open(array('route' => 'samples.all', 'class' => 'form-search pull-left', 'id' => 'samplelist')) }}
            {{ csrf_field() }}
    @if(old('from') == '')
   	{{ Form::text('from', $this_week['start'], ['class' => 'input-field filter-date', 'id' => 'from', 'placeholder' => 'From']) }}
   @else
   	{{ Form::text('from', old('from'), ['class' => 'input-field filter-date', 'id' => 'from', 'placeholder' => 'From']) }}
   @endif
   @if(old('to') == '')
   {{ Form::text('to', $this_week['end'], ['class' => 'input-field filter-date', 'id' => 'to', 'placeholder' => 'To']) }}
   @else
   {{ Form::text('to', old('to'), ['class' => 'input-field filter-date', 'id' => 'to', 'placeholder' => 'To']) }}
   @endif
   {{Form::select('status', $status_dropdown, $request->status, ['class'=>'selectdropdown autosubmitsearchform'])}}
@role(['national_hub_coordinator','administrator']) 
    {{Form::select('hubid', $hubs, $request->hubid, ['class'=>'selectdropdown autosubmitsearchform'])}}
    @endrole
   {{Form::select('facilityid', $facilities, $request->facilityid, ['class'=>'selectdropdown autosubmitsearchform'])}} 
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
            <th>Package ID</th>
          <th>Facility</th>
          @role(['national_hub_coordinator'])
        <th>Hub </th>
        @endrole
          <th>Sample Type</th>
          <th>No. Samples</th>
          <th>Picked from facility at</th>
          <th>Status</th>
          <th>Received at Hub</th>
          <th>Received at CPHL</th>
          <th>Hub TAT</th>
          <th>CPHL TAT</th>
          <th>Action</th>
          
        </tr>
      </thead>
      <tbody>      
      @foreach ($package_samples as $sample)
      <tr>
      <td>{{$sample->barcode}}</td>
        <td>{{$sample->sourcefacility}}</td>
        @role(['national_hub_coordinator'])
        <td>{{$sample->destinationfacility}} </td>
        @endrole
        <td>{{$sample->sampletype}}</td>
        <td>{{$sample->numberofsamples}}</td>
        <td>{{$sample->taken_at}}</td>
        <td> 
        @if($sample->status < 4)
        {{$status_dropdown_for_hubs[$sample->status]}} {{$sample->destinationfacility}}
        @else
        {{$status_dropdown[$sample->status]}} 
        @endif
        </td>
        <td>
        @if($sample->recieved_at != '')
        {{$sample->recieved_at}}
        @else
        {{$sample->delivered_at}}
        @endif
        </td>
        <td>{{$sample->received_at_cphl_on}}</td>
        <td>{{getTAT('', $sample->taken_at,$sample->delivered_at)}}</td>
        <td>{{getTAT($sample->delivered_at,$sample->recieved_at, $sample->received_at_cphl_on)}}</td>
        
        
        <td>     
        @role(['hub_coordinator'])  
        @if($sample->status == 2 && Auth::user()->hubid = $sample->destinationfacility)        
        @endif
        @endrole

        @role(['cphl_sample_reception'])
       @if($sample->status < 7)
        <a href="{{ route('sampletracking.receivesample',$sample->id) }}" id="{{$sample->id}}" class="rec_sample">Receive</a>
       @endif
        @endrole
        </td>
        
      </tr>
      @endforeach
        </tbody>      
    </table>
  </div>
  <!-- /.box-body --> 
</div>


<!-- The Modal - no barcode-->
<div>
<div class="modal" id="no_barcode">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Barcode not Scanned</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->

      <div class="modal-body">
        <p>The barcode was not scanned so, record its details here for follow-up</p>
        {{ Form::open(array('route' => 'samples.saveunscannedbarcode', 'class' => '', 'id' => 'unscanned')) }}
            {{ csrf_field() }}
            <div class="form-group">
              <label for="hub" class="control-label">Hub</label>
              <div>
                {{Form::select('hubid', $hubs, old('hubid'), ['class'=>'form-control input-lg'])}}                     
              </div>
            </div>
            <div class="form-group">
              <label for="hub" class="control-label">Facility</label>
              <div>
                {{Form::select('facilityid', $facilities, old('facilityid'), ['class'=>'form-control input-lg'])}}                     
              </div>
            </div>
            <div class="form-group">
              <label for="insurance" class="control-label">Barcode</label>

              <div>
                {{ Form::text('barcode', old('barcode'), array('class' => 'form-control', 'id' => 'barcode')) }}
              </div>
            </div>
            <div class="form-group">
                <div>
                  {{ Form::hidden('type', 1) }}
                    <button type="submit" id="submit_form" class="btn btn-primary">Submit </button>
                    </button>
                </div>
            </div>
            {{ Form::close() }}
      </div>

   </div>
</div>
</div>
<!-- End The Modal - no barcode-->
<!-- The Modal - enter number of samples-->
<div class="modal" id="no_samples">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Number of samples</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->

      <div class="modal-body">
        {{ Form::open(array('route' => 'samples.receivesmallpackage', 'class' => '', 'id' => 'no_s')) }}
            {{ csrf_field() }}
          <div class="form-group">
              <label for="insurance" class="control-label">Barcode</label>

              <div>
                {{ Form::text('numberofsamples', old('numberofsamples'), array('class' => 'form-control', 'id' => 'number_of_samples')) }}
              </div>
            </div>
            <div class="form-group">
                <div>
                  <input type="text" name="id" value="" class="hidden" id="the_id">
                    <button type="submit" id="submit_form" class="btn btn-primary">Submit </button>
                    </button>
                </div>
            </div>
            {{ Form::close() }}
      </div>

   </div>
</div>
<!-- end The Modal - enter number of samples-->

@endsection