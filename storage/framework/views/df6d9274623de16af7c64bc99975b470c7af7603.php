

<?php $__env->startSection('title', 'Create New Bike'); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script>

 <script>
	$(document).ready(function() {
		
		$('#deliveredtohubon, #purchasedon').datepicker({
		   format: 'mm/dd/yyyy',
           endDate: '+0d',
		   autoclose: true
		});
		
		$('#equipmentform').bootstrapValidator({
       
        fields: {
			enginenumber: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the engine number'
                        }
                    }
                },
			facilityid: {
				validators: {
					notEmpty: {
						message: 'Please select the hub'
					}
				}
			},
            brand: {
                    validators: {
                        notEmpty: {
                            message: 'Please select the description'
                        }
                    }
                },  
			numberplate: {
				validators: {
					notEmpty: {
						message: 'Please select the number plate'
					}
				}
			},  
			chasisnumber: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the chasis number'
                        }
                    }
                }
		}//endo of validation rules
    });// close form validation function
	});
	
	$(function () {

    //Datemask dd/mm/yyyy
    $('#purchasedon, #deliveredtohubon').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

  })
  (function($) {
    $.fn.bootstrapValidator.validators.greaterDate = {
      validate: function(validator, $field, options) {
        var value = $field.val();
        if (value === '') {
          return true;
        }
  
        return true;
      }
    };
}(window.jQuery));
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
            
    		<?php echo e(Form::open(array('route' => 'equipment.store', 'class' => 'form-horizontal', 'id' => 'equipmentform'))); ?>

            <?php echo e(csrf_field()); ?>

              <div class="box-body create">
              <?php if (\Entrust::hasRole(['administrator','national_hub_coordinator'])) : ?> 
              <div class="form-group">
                  <label for="facility" class="col-sm-3 control-label"><?php echo e(Form::label('facility', 'Hub')); ?></label>
                  <div class="col-sm-9">
                    <?php echo e(Form::select('facilityid', $hubsdropdown, null, ['class' => 'form-control'])); ?>                     
                  </div>
                </div>
                <?php endif; // Entrust::hasRole ?>
                <div class="form-group">
                  <label for="enginenumber" class="col-sm-3 control-label"><?php echo e(Form::label('enginenumber', 'Engine Number')); ?></label>

                  <div class="col-sm-9">
                    <?php echo e(Form::text('enginenumber', null, array('class' => 'form-control', 'id' => 'enginenumber'))); ?>

                  </div>
                </div>
                <div class="form-group">
                  <label for="numberplate" class="col-sm-3 control-label"><?php echo e(Form::label('numberplate', 'Number Plate')); ?></label>
                  <div class="col-sm-9">
                    <?php echo e(Form::text('numberplate', null, array('class' => 'form-control', 'id' => 'numberplate'))); ?>

                  </div>
                </div>
               <div class="form-group">
                  <label for="chasisnumber" class="col-sm-3 control-label"><?php echo e(Form::label('chasisnumber', 'Chasis Number')); ?></label>

                  <div class="col-sm-9">
                    <?php echo e(Form::text('chasisnumber', null, array('class' => 'form-control', 'id' => 'chasisnumber'))); ?>

                  </div>
                </div>
                <div class="form-group">
                  <label for="brand" class="col-sm-3 control-label"><?php echo e(Form::label('brand', 'Make/Type')); ?></label>

                  <div class="col-sm-9">
                    <?php echo e(Form::text('brand', null, array('class' => 'form-control', 'id' => 'brand'))); ?>

                  </div>
                </div>
                <div class="form-group" style="display:none;">
                  <label for="modelnumber" class="col-sm-3 control-label"><?php echo e(Form::label('modelnumber', 'Model Number')); ?></label>

                  <div class="col-sm-9">
                    <?php echo e(Form::text('modelnumber', null, array('class' => 'form-control', 'id' => 'modelnumber'))); ?>

                  </div>
                </div>
                <div class="form-group" style="display:none;">
                  <label for="color" class="col-sm-3 control-label"><?php echo e(Form::label('color', 'Color')); ?></label>

                  <div class="col-sm-9">
                    <?php echo e(Form::text('color', null, array('class' => 'form-control', 'id' => 'color'))); ?>

                  </div>
                </div>
                                
                <div class="form-group">
                  <label for="enginecapacity" class="col-sm-3 control-label"><?php echo e(Form::label('enginecapacity', 'Engine Capacity')); ?></label>

                  <div class="col-sm-9">
                    <?php echo e(Form::text('enginecapacity', null, array('class' => 'form-control', 'id' => 'enginecapacity'))); ?>

                  </div>
                </div>
                
                <div class="form-group">
                  <label for="yearofmanufacture" class="col-sm-3 control-label"><?php echo e(Form::label('yearofmanufacture', 'Year of Manufacture')); ?></label>

                  <div class="col-sm-9">
                    <?php echo e(Form::text('yearofmanufacture', null, array('class' => 'form-control', 'id' => 'yearofmanufacture'))); ?>

                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="purchasedon" class="col-sm-3 control-label"><?php echo e(Form::label('purchasedon', 'Purchased on')); ?></label>
                  <div class="col-sm-9">
                    
                    <input name="purchasedon" id="purchasedon" class="form-control"  type="text">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="warrantyperiod" class="col-sm-3 control-label"><?php echo e(Form::label('warrantyperiod', 'Warranty Period')); ?></label>
                  <div class="col-sm-7">
                    <?php echo e(Form::text('warrantyperiod', null, array('class' => 'form-control', 'id' => 'warrantyperiod'))); ?>

                  </div><div class="col-sm-2">                
                  <?php echo e(Form::select('warrantyperiodunits', $warrantyunitsdropdown, null, ['class' => 'form-control'])); ?>

                  </div>  
                </div>
                
                <div class="form-group">
                  <label for="warrantyperiod" class="col-sm-3 control-label"><?php echo e(Form::label('warrantyperiod', 'Recommended Service Frequency')); ?></label>
                	<div class="col-sm-7">
                    <?php echo e(Form::text('recommendedservicefrequency', null, array('class' => 'form-control', 'id' => 'recommendedservicefrequency'))); ?>

                  </div><div class="col-sm-2"><?php echo e(Form::select('servicefrequencyunits', $servicefreqdropdown, null, ['class' => 'form-control'])); ?></div>  
                </div>    
                
                
                 <div class="form-group">
                  <label for="warrantyperiod" class="col-sm-3 control-label"><?php echo e(Form::label('hasservicecontract', 'Has Service Contract')); ?></label>
                	<div class="col-sm-8">
                    <?php echo e(Form::radio('hasservicecontract', 1, null, ['class' => ''])); ?> Yes
                    <?php echo e(Form::radio('hasservicecontract', 0, null, ['class' => ''])); ?> No
                  </div><div class="col-sm-1"></div>  
                </div>          
                              
                <div class="form-group">
                  <label for="insurance" class="col-sm-3 control-label"><?php echo e(Form::label('insurance', 'Insurance')); ?></label>

                  <div class="col-sm-9">
                    <?php echo e(Form::text('insurance', null, array('class' => 'form-control', 'id' => 'insurance'))); ?>

                  </div>
                </div>
                
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-danger" href="<?php echo e(URL::previous()); ?>">Cancel</a></button>
                <?php echo e(Form::submit('Create Bike', array('class' => 'btn btn-info pull-right'))); ?>

              </div>
              <!-- /.box-footer -->
            
            <?php echo e(Form::close()); ?>

          </div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>