<?php $__env->startSection('title', 'Update Facility'); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script>
 <script>
	$(document).ready(function() {
		$('#facilityform').bootstrapValidator({
       
        fields: {
			name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter a name'
                        }
                    }
                }, 
      distancefromhub: {
          validators: {
              numeric: {
                  message: 'Please enter a valid value'
              },
              between: {
                        min: -0,
                        max: 100,
                        message: 'The distance must be between 0 and 90 KM'
              }
          }
      }, 
			facilitylevelid: {
                    validators: {
                        notEmpty: {
                            message: 'Please select the facility level'
                        }
                    }
                },
				districtid: {
                    validators: {
                        notEmpty: {
                            message: 'Please select a district'
                        }
                    }
                },
				hubid: {
                    validators: {
                        notEmpty: {
                            message: 'Please select a hub'
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
            
            <?php echo e(Form::model($facility, array('route' => array('facility.update', $facility->id),  'class' => 'form-horizontal', 'id' => 'facilityform', 'method' => 'PUT'))); ?>

            <?php echo e(csrf_field()); ?>

              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label"><?php echo e(Form::label('name', 'Name')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::text('name', $facility->name, array('class' => 'form-control', 'id' => 'name'))); ?>

                  </div>
                </div>
                <div class="form-group">
                  <label for="healthregionid" class="col-sm-2 control-label"><?php echo e(Form::label('hubid', 'Hub')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::select('parentid', $hubsdropdown, $facility->parentid, ['class' => 'form-control'])); ?>

                     
                  </div>
                </div>
                <div class="form-group">
                  <label for="facilitylevelid" class="col-sm-2 control-label"><?php echo e(Form::label('facilitylevelid', 'Level')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::select('facilitylevelid', $facilityleveldropdown, $facility->facilitylevelid, ['class' => 'form-control'])); ?>

                     
                  </div>
                </div>
                 <div class="form-group">
                  <label for="districtid" class="col-sm-2 control-label"><?php echo e(Form::label('districtID', 'District')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::select('districtid', $districtdropdown, $facility->districtid, ['class' => 'form-control'])); ?>

                     
                  </div>
                </div>
                
                <div class="form-group">
                <label for="distancefromhub" class="col-sm-2 control-label"><?php echo e(Form::label('distancefromhub', 'Distance from Hub')); ?></label>
                <div class="col-sm-8">
                    <div class="input-group">
                    <?php echo e(Form::text('distancefromhub', $facility->distancefromhub, array('class' => 'form-control', 'id' => 'distancefromhub'))); ?>

                    
                    <span class="input-group-addon">KM</span>
                  </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="incharge" class="col-sm-2 control-label"><?php echo e(Form::label('incharge', 'Incharge')); ?></label>

                  <div class="col-sm-5">
                    <?php echo e(Form::text('incharge', $facility->incharge, array('class' => 'form-control', 'id' => 'incharge', 'placeholder' => 'Name'))); ?>

                  </div>
                  <div class="col-sm-5">
                    <?php echo e(Form::text('inchargephonenumber', $facility->inchargephonenumber, array('class' => 'form-control', 'id' => 'inchargephonenumber','placeholder'=>'Phone number'))); ?>

                  </div>
                </div>
              
                <div class="form-group">
                  <label for="labmanager" class="col-sm-2 control-label"><?php echo e(Form::label('labmanager', 'Lab Manager')); ?></label>

                  <div class="col-sm-5">
                    <?php echo e(Form::text('labmanager', $facility->labmanager, array('class' => 'form-control', 'id' => 'labmanager', 'placeholder' => 'Name'))); ?>

                  </div>
                  <div class="col-sm-5">
                    <?php echo e(Form::text('labmanagerphonenumber', $facility->labmanagerphonenumber, array('class' => 'form-control', 'id' => 'labmanagerphonenumber', 'placeholder' => 'Phone Number'))); ?>

                  </div>
                </div>
                
                <div class="form-group hidden">
                  <label for="address" class="col-sm-2 control-label"><?php echo e(Form::label('address', 'Physical Address')); ?></label>

                  <div class="col-sm-10">
                    <?php echo e(Form::textarea('address', null, array('class' => 'form-control', 'id' => 'address'))); ?>

                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-sm btn-danger" href="<?php echo e(URL::previous()); ?>">Cancel</a></button>
                <?php echo e(Form::submit('Update Facility', array('class' => 'btn btn-sm btn-warning pull-right'))); ?>

              </div>
              <!-- /.box-footer -->
            
            <?php echo e(Form::close()); ?>

          </div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>