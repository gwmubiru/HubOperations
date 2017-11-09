@extends('layouts.app')

@section('title', 'View Bike Details')

@section('content')
<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Bike Details</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Bike Routes</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Bike Maintenance Details</a></li>
        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="col-xs-12 table-responsive">
            <table class="table view">
              <tbody>
                <tr class="first-row">
                  <td>Number Plate</td>
                  <td>{{ $equipment->numberplate }}</td>
                </tr>
                <tr>
                  <td>Engine Number</td>
                  <td>{{ $equipment->enginenumber }}</td>
                </tr>
                <tr>
                  <td>Chasis Number</td>
                  <td>{{ $equipment->chasisnumber }}</td>
                </tr>
                <tr>
                  <td>Year of Manufacture</td>
                  <td>{{ $equipment->yearofmanufacture }}</td>
                </tr>
                <tr>
                  <td>Color</td>
                  <td>{{ $equipment->color }}</td>
                </tr>
                <tr>
                  <td>Model Number</td>
                  <td>{{ $equipment->modelnumber }}</td>
                </tr>
                <tr>
                  <td>Brand</td>
                  <td>{{ $equipment->brand }}</td>
                </tr>
                <tr>
                  <td>Engine Capacity</td>
                  <td>{{ $equipment->enginecapacity }}</td>
                </tr>
                <tr>
                  <td>Insurance</td>
                  <td>{{ $equipment->insurance }}</td>
                </tr>
                <tr>
                  <td>Hub</td>
                  <td>{{ $equipment->hub->name }}</td>
                </tr>
                <tr>
                  <td>Purchased on</td>
                  <td>{{ date('d/m/Y', strtotime($equipment->purchasedon)) }}</td>
                </tr>
                <tr>
                  <td>Delivered to Hub on</td>
                  <td>{{ date('d/m/Y', strtotime($equipment->deliveredtohubon)) }}</td>
                </tr>
                <tr>
                  <td>Warranty Period</td>
                  <td>{{ $equipment->warrantyperiod }}</td>
                </tr>
                <tr>
                  <td>Recommended Service Frequency</td>
                  <td>{{ $equipment->recommendedservicefrequency }}</td>
                </tr>
                <tr>
                  <td>Has Service Contract</td>
                  <td>{{ getLookupValueDescription("YES_NO", $equipment->hasservicecontract)}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2"> Coming soon Coming soonComing soonComing soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soonComing soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soonv Coming soon Coming soonComing soon Coming soon Coming soonComing soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soon Coming soonComing soon </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3"> Coming soon. </div>
        <!-- /.tab-pane --> 
      </div>
      <!-- /.tab-content --> 
    </div>
  </div>
</div>
@endsection 