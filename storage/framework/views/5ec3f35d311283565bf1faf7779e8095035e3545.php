<?php $__env->startSection('title', 'Create Hub'); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script>
 <script>
	$(document).ready(function() {
		$('#hubform').bootstrapValidator({
       
        fields: {
			name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter a name'
                        }
                    }
                },
                
			healthregionid: {
                    validators: {
                        notEmpty: {
                            message: 'Please select a health region'
                        }
                    }
                },
				parentid: {
                    validators: {
                        notEmpty: {
                            message: 'Please select the facility to which this hub is attached'
                        }
                    }
                },
				ipid: {
                    validators: {
                        notEmpty: {
                            message: 'Please select the IP'
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
    
    <?php if( ! $errors->isEmpty() ): ?>
	<div class="row">
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="alert alert-danger fade in alert-dismissable" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Failed!</strong><?php echo e($error); ?> </div>   
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
	<?php endif; ?>
            <!-- /.box-header -->
            <!-- form start -->
            
    		<?php echo e(Form::open(array('route' => 'hub.store', 'class' => 'form-horizontal', 'id' => 'hubform'))); ?>

            <?php echo e(csrf_field()); ?>

              <div class="box-body">
              <div class="form-group">
                  <label for="name" class="col-sm-2 control-label"><?php echo e(Form::label('name', 'Name')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::text('name', null, array('class' => 'form-control', 'id' => 'name'))); ?>

                  </div>
                </div>
                <div class="form-group">
                  <label for="healthregionid" class="col-sm-2 control-label"><?php echo e(Form::label('healthregionid', 'Health Region')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::select('healthregionid', $healthregions, null, ['class' => 'form-control'])); ?>

                     
                  </div>
                </div>
                <div class="form-group">
                  <label for="ipid" class="col-sm-2 control-label"><?php echo e(Form::label('ipid', 'IP')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::select('ipid', $ips, null, ['class' => 'form-control'])); ?>

                     
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="ipid" class="col-sm-2 control-label"><?php echo e(Form::label('parentid', 'Based on (Facility)')); ?></label>
                  <div class="col-sm-10"> <?php echo e(Form::select('parentid', $facilities, null, ['class' => 'form-control'])); ?> </div>
                </div>
                                 
                <div class="form-group hidden">
                  <label for="address" class="col-sm-2 control-label"><?php echo e(Form::label('address', 'Address')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::textarea('address', null, array('class' => 'form-control', 'id' => 'address'))); ?>

                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-danger" href="<?php echo e(URL::previous()); ?>">Cancel</a></button>
                <?php echo e(Form::submit('Create Hub', array('class' => 'btn btn-info pull-right'))); ?>

              </div>
              <!-- /.box-footer -->
            
            <?php echo e(Form::close()); ?>

          </div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>