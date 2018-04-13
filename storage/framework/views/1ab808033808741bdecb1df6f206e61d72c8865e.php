<?php $__env->startSection('title', 'Add IP'); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script>
 <script>
	$(document).ready(function() {
		$('#ipform').bootstrapValidator({
       
        fields: {
			name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter a name'
                        }
                    }
                }, 
					emailaddress: {          
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
  
  <?php echo e(Form::model($organization, array('route' => array('organization.update', $organization->id),  'class' => 'form-horizontal', 'id' => 'ipform', 'method' => 'PUT'))); ?>

  <?php echo e(csrf_field()); ?>

  <div class="box-body">
    <div class="form-group">
      <label for="name" class="col-sm-2 control-label"><?php echo e(Form::label('name', 'Name')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::text('name', null, array('class' => 'form-control', 'id' => 'name'))); ?> </div>
    </div>
     <div class="form-group">
                  <label for="healthregionid" class="col-sm-2 control-label"><?php echo e(Form::label('healthregionid', 'Health Region')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::select('healthregionid', $healthregion, null, ['class' => 'form-control'])); ?>

                     
                  </div>
                </div>
    <div class="form-group">
      <label for="address" class="col-sm-2 control-label"><?php echo e(Form::label('address', 'Address')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::text('address', null, array('class' => 'form-control', 'id' => 'address'))); ?> </div>
    </div>
    <div class="form-group">
      <label for="telephonenumber" class="col-sm-2 control-label"><?php echo e(Form::label('telephonenumber', 'Telephone Number')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::text('telephonenumber', null, array('class' => 'form-control', 'id' => 'telephonenumber'))); ?> </div>
    </div>
    <div class="form-group">
      <label for="emailaddress" class="col-sm-2 control-label"><?php echo e(Form::label('emailaddress', 'Email Address')); ?></label>
      <div class="col-sm-10"> <?php echo e(Form::text('emailaddress', null, array('class' => 'form-control', 'id' => 'emailaddress'))); ?> </div>
    </div>
    
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <a class="btn btn-sm btn-danger" href="<?php echo e(URL::previous()); ?>">Cancel</a></button>
    <?php echo e(Form::submit('Update IP', array('class' => 'btn btn-sm btn-warning pull-right'))); ?> </div>
  <!-- /.box-footer --> 
  
  <?php echo e(Form::close()); ?> </div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>