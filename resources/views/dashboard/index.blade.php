@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
@section('js') 
<script src="{{ asset('js/fastclick.js') }}"></script> 
<script src="{{ asset('js/jquery.sparkline.min.js') }}"></script> 
<script src="{{ asset('js/jquery-jvectormap-1.2.2.min.js') }}"></script> 
<script src="{{ asset('js/jquery-jvectormap-world-mill-en.js') }}"></script> 
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script> 
<script src="{{ asset('js/Chart.js') }}"></script> 
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script> 
@append 
<!-- Info boxes -->
<div class="row panel-body">
  <div class="btn-group container col-md-12"> @role(['administrator','hub_coordinator','national_hub_coordinator'])
    <div class="row"> 
      
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box"> <span class="info-box-icon bg-red"><i class="fa fa-motorcycle"></i></span>
          <div class="info-box-content"> <span class="info-box-text"><a class="link-tip" href="{{url('equipment/list/status/2')}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Bikes Broken down">Bikes Broken down</a></span> <span class="info-box-number">{{count($equipment_broken_down)}}</span> </div>
          <!-- /.info-box-content --> 
        </div>
        <!-- /.info-box --> 
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box"> <span class="info-box-icon bg-yellow"><i class="fa fa-motorcycle"></i></span>
          <div class="info-box-content"> <span class="info-box-text"><a class="link-tip" href="{{url('equipment/list/service/0')}}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Bikes without Service Contract">Bikes without Service Contract</a></span> <span class="info-box-number">{{count($equipment_no_service)}}</span> </div>
          <!-- /.info-box-content --> 
        </div>
        <!-- /.info-box --> 
      </div>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box"> <span class="info-box-icon bg-aqua"><i class="fa fa-motorcycle"></i></span>
          <div class="info-box-content"> <span class="info-box-text"><a class="link-tip" href="#" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Bikes Due for Service">Bikes Due for Service</a></span> <span class="info-box-number">21</span> </div>
          <!-- /.info-box-content --> 
        </div>
        <!-- /.info-box --> 
      </div>
      
      <!-- /.col --> 
    </div>
    @endrole 
    <!-- /.row -->
    <div class="row" style="background-color:#fff; margin-left:0; margin-right:0; border-radius: 2px;"> 
      <!-- Left col -->
      <section class="col-lg-9">
        <div id="samples-chart" >
          <?php //echo lava::render('LineChart', 'samples', 'samples-chart'); ?>
          <?php echo lava::render('ColumnChart', 'samples', 'samples-chart'); ?> </div>
      </section>
      <section class="col-lg-3">
        <h2 style="margin-bottom:5px; margin-left:5px;">Summary</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
          	<tr>
                <th>Sample Type</th>
                <th>No. samples</th>
            </tr>
            @foreach($samples as $line)
            <tr>
              <td>{{$line->sampletype}} </td>
              <td>{{$line->samples}} </td>
            </tr>
            @endforeach
          </table>
        </div>
      </section>
      <div class="pull-right" style="margin-right:20px;"><a href="{{ route('dailyrouting.samplelist') }}"><i class="fa fa-fw fa-list"></i>View all</a></div>
    </div>
    <div class="row" style="background-color:#fff;margin-left:0; margin-right:0; margin-top:15px; border-radius: 2px;"> 
      <!-- Left col -->
      <section class="col-lg-9">
      
        <div id="results-chart" > <?php echo lava::render('ColumnChart', 'theresults', 'results-chart'); ?></div>
      </section>
      <section class="col-lg-3">
        <h2 style="margin-bottom:5px; margin-left:5px;">Summary</h2>
        <div class="table-responsive">
          <table class="table table-bordered">
          <tr>
            <th>Result Type</th>
            <th>No. results</th>
            </tr>
            @foreach($results as $line)
            <tr>
              <td>{{$line->resulttype}} </td>
              <td>{{$line->results}} </td>
            </tr>
            @endforeach
          </table>
        </div>
      </section>
      <div class="pull-right" style="margin-right:20px;"><a href="{{ route('dailyrouting.resultlist') }}"><i class="fa fa-fw fa-list"></i>View all</a></div>
    </div>
  </div>
</div>
@endsection