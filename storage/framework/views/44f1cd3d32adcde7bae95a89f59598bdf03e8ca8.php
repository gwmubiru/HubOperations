<?php $__env->startSection('title', 'Assign Hub to facility'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/select2.min.css')); ?>">
<?php $__env->appendSection(); ?>
<?php $__env->startSection('js'); ?> 
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script> 
<script src="<?php echo e(asset('js/select2.full.min.js')); ?>"></script> 
<script>
	$(document).ready(function() {
		$('.select2').select2();
		$('#assignfacilityform').bootstrapValidator({
       
        fields: {
			hub: {
                    validators: {
                        notEmpty: {
                            message: 'Please select a hub'
                        }
                    }
                },
			'facilities[]': {
                    validators: {
                        notEmpty: {
                            message: 'Please select at least one facility'
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
<?php $__env->appendSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="box box-info"> 
  
  <!-- /.box-header --> 
  <!-- form start --> 
  
  <?php echo e(Form::open(array('route' => 'hub.massassignfacilities', 'class' => 'form-horizontal', 'id' => 'assignfacilityform'))); ?>

  <?php echo e(csrf_field()); ?>

  <div class="box-body">
   
    <div class="form-group">
      <label for="hub" class="col-sm-2 control-label"><?php echo e(Form::label('hub', 'hub')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('hubid', $hubdropdown, null, ['class' => 'form-control', 'data-placeholder' => 'Select hub'])); ?> </div>
    </div>
    <div class="form-group">
      <label for="facilities" class="col-sm-2 control-label"><?php echo e(Form::label('facilities', 'Facilities')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('facilities[]', $facilitydropdown, null, ['class' => 'form-control select2 select2-hidden-accessible', 'multiple'=>"",'style'=>'width: 100%;', 'tabindex'=>'"-1"', 'aria-hidden'=>'"true"', 'data-placeholder' => 'Select all facilities for this hub'])); ?> </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer"> <a class="btn btn-default" href="<?php echo e(URL::previous()); ?>">Cancel</a>
    </button>    <?php echo e(Form::submit('Save', array('class' => 'btn btn-info pull-right'))); ?> </div>
  <!-- /.box-footer --> 
  
  <?php echo e(Form::close()); ?> </div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>