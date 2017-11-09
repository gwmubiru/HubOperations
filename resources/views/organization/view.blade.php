@extends('layouts.app')

@section('title', 'View IP')

@section('content')
<div class="box tabbed-view">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">IP Details</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Hubs Served</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Techinical Team</a></li>
        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="col-xs-12 table-responsive">
            <table class="table">
              <tbody>
                <tr class="first-row">
                  <td>Name</td>
                  <td>{{ $organization->name }}</td>
                </tr>
                <tr>
                  <td>Health Region</td>
                  <td>@if($organization->healthregionid){{ $organization->healthregion->name }}@endif</td>
                </tr>
                <tr>
                  <td>Telephone</td>
                  <td>{{ $organization->telephonenumber }}</td>
                </tr>
                <tr>
                  <td>Email Address</td>
                  <td>{{ $organization->emailaddress }}</td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td>{{ $organization->address }}</td>
                </tr>
                <tr>
                  <td>Support Agency</td>
                  <td>@if($organization->supportagencyid){{ $organization->supportagency->name }}@endif</td>
                </tr>
                <tr>
                  <td>Support Period</td>
                  <td>From {{ date('d/m/Y', strtotime($supportperiod[0]->startdate))}} to {{ date('d/m/Y', strtotime($supportperiod[0]->enddate))}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
        There are no hubs to display.
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Care & Treat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  @if($careandtreat)
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td>{{$careandtreat->firstname.' '.$careandtreat->lastname.' '.$careandtreat->othernames}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td>{{$careandtreat->telephonenumber}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td>{{$careandtreat->emailaddress}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                     @else
                    <p class="no-contact">You do not have any Care and Treat contact. Please click the button below to to add one.</p>
                    @endif
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> @if(!$careandtreat)<a href="{{url('contact/new/category/1/type/1/obj', ['obj' => $organization->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a>@else 
                <a href="{{url('contact/new/category/1/type/1/obj', ['obj' => $organization->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="{{route('contact.edit', $careandtreat->id)}}" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> @endif</div>
                <!-- /.box-footer --> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Lab Technitian</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  @if($labtech)
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td>{{$labtech->firstname.' '.$labtech->lastname.' '.$labtech->othernames}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td>{{$labtech->telephonenumber}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td>{{$labtech->emailaddress}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                    @else
                    <p class="no-contact">You do not have any Lab tech contact. Please click the button below to to add one.</p>
                    @endif
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> @if(!$labtech)<a href="{{url('contact/new/category/1/type/2/obj', ['obj' => $organization->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a>@else 
                <a href="{{url('contact/new/category/1/type/2/obj', ['obj' => $organization->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="{{route('contact.edit', $careandtreat->id)}}" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> @endif</div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">PMTC/EMTC</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  @if($pmtc)
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td>{{$pmtc->firstname.' '.$pmtc->lastname}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td>{{$pmtc->telephonenumber}}</td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td>{{$pmtc->emailaddress}}</td>
                        </tr>
                        
                      </tbody>
                    </table>
                     @else
                    <p class="no-contact">You do not have any Care and Treat contact. Please click the button below to to add one.</p>
                    @endif
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> @if(!$pmtc)<a href="{{url('contact/new/category/1/type/3/obj', ['obj' => $organization->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a>@else 
                <a href="{{url('contact/new/category/1/type/3/obj', ['obj' => $organization->id])}}" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="{{route('contact.edit', $careandtreat->id)}}" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> @endif</div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
        </div>
        <!-- /.tab-pane --> 
      </div>
      <!-- /.tab-content --> 
    </div>
  </div>
</div>
@endsection 