@extends('layouts.app')

@section('title', 'Dashboard')
@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
@append
@section('js') 
<script>
$(document).ready(function() {
} );
 function readyCallback (event, chart) {
        console.log(event, chart);
      }

      function mouseOverCallback (event, chart) {
        console.log(event, chart);
      }

      function mouseOutCallback (event, chart) {
        console.log(event, chart);
      }

      function selectCallback (event, chart) {
        console.log(event, chart);
      }
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
  <section class="content"> 
    <!-- Small boxes (Stat box) --> 
    
    <!-- /.row --> 
    <!-- Main row -->
    <div class="row"> 
      <!-- Left col -->
      <section class="col-lg-12"> 
         <div id="stocks-chart" >
    <?php echo lava::render('LineChart', 'MyStocks', 'stocks-chart'); ?></div>
      </section>
     </div>
    <div class="row"> 
      <!-- Left col -->
      <section class="col-lg-5"> 
         <div id="stocks-chart" >
    <?php echo lava::render('LineChart', 'MyStocks', 'stocks-chart'); ?></div>
      </section>
      <!-- /.Left col --> 
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable"> 
        
        <!-- solid sales graph -->
        <div class="box box-solid bg-teal-gradient">
          <div class="box-header"> <i class="fa fa-th"></i>
            <h3 class="box-title">Sales Graph</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i> </button>
              <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i> </button>
            </div>
          </div>
          <div class="box-body border-radius-none">
            <div class="chart" id="line-chart" style="height: 250px;"></div>
          </div>
        </div>
        <!-- /.box --> 
        
        <!-- Calendar --> 
        
        <!-- /.box --> 
        
      </section>
      <!-- right col --> 
    </div>
    <!-- /.row (main row) --> 
    
  </section>
</div>
@endsection