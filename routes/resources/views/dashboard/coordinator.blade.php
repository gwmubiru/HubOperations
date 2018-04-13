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
    <div class="row"> 
      <!-- Left col -->
      <section class="col-lg-12"> 
         <div id="stocks-chart" >
    <?php echo lava::render('LineChart', 'MyStocks', 'stocks-chart'); ?></div>
      </section>
     </div>
  </section>
</div>
@endsection