
<?php $__env->startSection('title', 'Add Routing Schedule'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/select2.min.css')); ?>">
<?php $__env->appendSection(); ?>
<?php $__env->startSection('js'); ?> 
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script> 
<script src="<?php echo e(asset('js/select2.full.min.js')); ?>"></script> 
<script>
	$(document).ready(function() {
		$('.select2').select2();
		$('#routingscheduleform').bootstrapValidator({
       
        fields: {
			monday: {
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
  
  <?php echo e(Form::open(array('route' => 'routingschedule.store', 'class' => 'form-horizontal', 'id' => 'routingscheduleform'))); ?>

  <?php echo e(csrf_field()); ?>

  <div class="box-body">
    <div class="form-group">
      <label for="monday" class="col-sm-2 control-label"><?php echo e(Form::label('monday', 'Monday')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('monday[]', $facilitydropdown, null, ['class' => 'form-control select2 select2-hidden-accessible', 'multiple'=>"",'style'=>'width: 100%;', 'tabindex'=>'"-1"', 'aria-hidden'=>'"true"', 'data-placeholder'=>'Select facilities visited on Monday'])); ?> </div>
    </div>
    <div class="form-group">
      <label for="tuesday" class="col-sm-2 control-label"><?php echo e(Form::label('tuesday', 'Tuesday')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('tuesday[]', $facilitydropdown, null, ['class' => 'form-control select2 select2-hidden-accessible', 'multiple'=>"",'style'=>'width: 100%;', 'tabindex'=>'"-1"', 'aria-hidden'=>'"true"', 'data-placeholder' => 'Select facilities visited on Monday'])); ?> </div>
    </div>
    <div class="form-group">
      <label for="wednesday" class="col-sm-2 control-label"><?php echo e(Form::label('wednesday', 'Wednesday')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('wednesday[]', $facilitydropdown, null, ['class' => 'form-control select2 select2-hidden-accessible', 'multiple'=>"",'style'=>'width: 100%;', 'tabindex'=>'"-1"', 'aria-hidden'=>'"true"', 'data-placeholder' => 'Select facilities visited on Wednesday'])); ?> </div>
    </div>
    <div class="form-group">
      <label for="thursday" class="col-sm-2 control-label"><?php echo e(Form::label('thursday', 'Thursday')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('thursday[]', $facilitydropdown, null, ['class' => 'form-control select2 select2-hidden-accessible', 'multiple'=>"",'style'=>'width: 100%;', 'tabindex'=>'"-1"', 'aria-hidden'=>'"true"', 'data-placeholder' => 'Select facilities visited on Thursday'])); ?> </div>
    </div>
    <div class="form-group">
      <label for="friday" class="col-sm-2 control-label"><?php echo e(Form::label('friday', 'Friday')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('friday[]', $facilitydropdown, null, ['class' => 'form-control select2 select2-hidden-accessible', 'multiple'=>"",'style'=>'width: 100%;', 'tabindex'=>'"-1"', 'aria-hidden'=>'"true"', 'data-placeholder' => 'Select facilities visited on Friday'])); ?> </div>
    </div>
    <div class="form-group">
      <label for="saturday" class="col-sm-2 control-label"><?php echo e(Form::label('saturday', 'Saturday')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('saturday[]', $facilitydropdown, null, ['class' => 'form-control select2 select2-hidden-accessible', 'multiple'=>"",'style'=>'width: 100%;', 'tabindex'=>'"-1"', 'aria-hidden'=>'"true"', 'data-placeholder' => 'Select facilities visited on Saturday'])); ?> </div>
    </div>
    <div class="form-group">
      <label for="sunday" class="col-sm-2 control-label"><?php echo e(Form::label('sunday', 'Sunday')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::select('sunday[]', $facilitydropdown, null, ['class' => 'form-control select2 select2-hidden-accessible', 'multiple'=>"",'style'=>'width: 100%;', 'tabindex'=>'"-1"', 'aria-hidden'=>'"true"', 'data-placeholder' => 'Select facilities visited on Sunday'])); ?> </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer"> <a class="btn btn-default" href="<?php echo e(URL::previous()); ?>">Cancel</a>
    </button>
    <?php echo e(Form::hidden('hubid', $hubid)); ?>

    <?php echo e(Form::submit('Create Routing Schedule', array('class' => 'btn btn-info pull-right'))); ?> </div>
  <!-- /.box-footer --> 
  
  <?php echo e(Form::close()); ?> </div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>