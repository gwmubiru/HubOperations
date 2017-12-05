@extends('layouts.app')
@if ($pagetype == 1)
	@section('title', 'Add New Sample Transporter')
@else
	@section('title', 'Add New Sample Transporter')
@endif
@section('js')
<script src="{{ asset('js/bootstrapValidator.min-0.5.1.js') }}"></script>
 <script>
	$(document).ready(function() {
		
	$("select[name='facilityid']").change(function(){
      var id = $(this).val();
      var token = $("input[name='_token']").val();
      $.ajax({
          url: "<?php echo url('staff/bikewithoutrider'); ?>",
          method: 'POST',
          data: {hubid:id, _token:token},
          success: function(data) {
			  	$("#motorbikeid").html("").prepend("<option value=''>Select One</option>"); 
			    $("select[name='motorbikeid'").html('');
				$("select[name='motorbikeid'").html(data.options);
			  }
		  });
	  	});
		
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
				drivingpermit: {
                    validators: {
                        integer: {
                            message: 'Please enter a number'
                        },
						stringLength: {
							  min: 8,
							  max: 8,
							  message: 'Permit number should be 8 digits long'
						}
                    }
                },
				nationalid: {
                    validators: {
						stringLength: {
							  min: 14,
							  max: 14,
							  message: 'The NIN should be 14 characters long'
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
         @endif
            
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
                    {{ Form::select('facilityid', $hubsdropdown, null, ['class' => 'form-control', 'id' => 'facilityid']) }}
                     
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
                      <label for="drivingpermit" class="col-sm-2 control-label">{{ Form::label('drivingpermit', 'Driving Permit No.') }}</label>
    
                      <div class="col-sm-10">
                        {{ Form::text('drivingpermit', null, array('class' => 'form-control', 'id' => 'drivingpermit')) }}
                        @if ($errors->has('drivingpermit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('drivingpermit') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                 @endif
                <div class="form-group">
                  <label for="nationalid" class="col-sm-2 control-label">{{ Form::label('nationalid', 'National ID (NIN)') }}</label>

                  <div class="col-sm-10">
                  	{{ Form::hidden('type', $pagetype) }}
                    {{ Form::text('nationalid', null, array('class' => 'form-control', 'id' => 'nationalid')) }}
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-sm btn-danger" href="{{ URL::previous() }}">Cancel</a>
                {{ Form::submit('Create Sample Transporter', array('class' => 'btn btn-sm btn-info pull-right')) }}
              </div>
              <!-- /.box-footer -->
            
            {{ Form::close() }}
          </div>
@endsection 