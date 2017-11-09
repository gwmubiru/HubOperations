@extends('layouts.app')
@if ($pagetype == 1)
	@section('title', 'Add New Sample Transporter')
@else
	@section('title', 'Add New Staff Member')
@endif
@section('js')
<script src="{{ asset('js/bootstrapValidator.min-0.5.1.js') }}"></script>
 <script>
	$(document).ready(function() {
		$('#staffform').bootstrapValidator({
       
        fields: {
			facilityid: {
                    validators: {
                        notEmpty: {
                            message: 'Please select a hub'
                        }
                    }
                },
                
			firstname: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the first name'
                        }
                    }
                },
				lastname: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the last name'
                        }
                    }
                },
				telephonenumber: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the telephone number'
                        }
                    }
                },
					email: {          
				validators: {
							regexp: {
							  regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
							  message: 'The value is not a valid email address'
							}
						}
					}
		}//endo of validation rules
    });// close form validation function
	});
</script>
@append
@section('content')
	<div class="box box-info">
            
            <!-- /.box-header -->
            <!-- form start -->
            {{-- Using the Laravel HTML Form Collective to create our form --}}
    		{{ Form::open(array('route' => 'staff.store', 'class' => 'form-horizontal', 'id' => 'staffform')) }}
            	{{ csrf_field() }}
              <div class="box-body">
              @role('Admin','Regional_hub_coordinator','Program_officer')
              <div class="form-group">
                  <label for="facility" class="col-sm-2 control-label">{{ Form::label('facility', 'Hub') }}</label>

                  <div class="col-sm-10">
                    {{ Form::select('facilityid', $hubsdropdown, null, ['class' => 'form-control']) }}
                     
                  </div>
                </div>             
                @endrole
                 <div class="form-group">
                  <label for="motorbikeid" class="col-sm-2 control-label">{{ Form::label('bikes', 'Motor Bike') }}</label>

                  <div class="col-sm-10">
                    {{ Form::select('motorbikeid', $bikes, null, ['class' => 'form-control']) }}
                     
                  </div>
                </div>
              @if ($pagetype == 2)
              	<div class="form-group">
                  <label for="designation" class="col-sm-2 control-label">{{ Form::label('designation', 'Designation') }}</label>

                  <div class="col-sm-10">
                    {{ Form::select('designation', $designation, null, ['class' => 'form-control']) }}
                     
                  </div>
                </div>
              @endif
                <div class="form-group">
                  <label for="firstname" class="col-sm-2 control-label">{{ Form::label('firstname', 'First Name') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('firstname', null, array('class' => 'form-control', 'id' => 'firstname')) }}
                  </div>
                </div>
               <div class="form-group">
                  <label for="lastname" class="col-sm-2 control-label">{{ Form::label('lastname', 'Last Name') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('lastname', null, array('class' => 'form-control', 'id' => 'lastname')) }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="othernames" class="col-sm-2 control-label">{{ Form::label('othernames', 'Other Names') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('othernames', null, array('class' => 'form-control', 'id' => 'othernames')) }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="emailaddress" class="col-sm-2 control-label">{{ Form::label('emailaddress', 'Email Address') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('emailaddress', null, array('class' => 'form-control', 'id' => 'emailaddress')) }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="telephonenumber" class="col-sm-2 control-label">{{ Form::label('telephonenumber', 'Telephone Number') }}</label>

                  <div class="col-sm-10">
                    {{ Form::text('telephonenumber', null, array('class' => 'form-control', 'id' => 'telephonenumber')) }}
                  </div>
                </div>
                @if ($pagetype == 1)
                    <div class="form-group">
                      <label for="drivingpermitnumber" class="col-sm-2 control-label">{{ Form::label('drivingpermitnumber', 'Driving Permit') }}</label>
    
                      <div class="col-sm-10">
                        {{ Form::text('drivingpermitnumber', null, array('class' => 'form-control', 'id' => 'drivingpermitnumber')) }}
                      </div>
                    </div>
                 @endif
                <div class="form-group">
                  <label for="nationalid" class="col-sm-2 control-label">{{ Form::label('nationalid', 'National ID') }}</label>

                  <div class="col-sm-10">
                  	{{ Form::hidden('type', $pagetype) }}
                    {{ Form::text('nationalid', null, array('class' => 'form-control', 'id' => 'nationalid')) }}
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-danger" href="{{ URL::previous() }}">Cancel</a></button>
                {{ Form::submit('Create Staff', array('class' => 'btn btn-info pull-right')) }}
              </div>
              <!-- /.box-footer -->
            
            {{ Form::close() }}
          </div>
@endsection 