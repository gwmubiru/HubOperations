


<?php $__env->startSection('title', 'Add User'); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script>
 <script>
	$(document).ready(function() {
		//display hub dropdown if In-charge option is checked
		$('#role5, #role1').click(function(){
			if($('#role5').is(':checked') || $('#role1').is(':checked')){
				$('#hub').removeClass('hidden');
			}else{
				if ($('#hubid').val() !== '') {
					$('#hubid').val('');    
				}  
				$('#hub').addClass('hidden');
			}
		});
		//display hub dropdown if Regional hub coordinator option is checked
		$('#role4').click(function(){
			if($(this).is(':checked')){
				$('#hr').removeClass('hidden');
			}else{
				if ($('#healthregionid').val() !== '') {
					$('#healthregionid').val('');    
				} 
				$('#hr').addClass('hidden');
			}
		});
	
		$('#userform').bootstrapValidator({
       
        fields: {
			name: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the name'
                        }
                    }
                },
				username: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter the username'
                        }
                    }
                },
				
				'roles[]': {
                    validators: {
                        notEmpty: {
                            message: 'Please select atleast one role for the user'
                        }
                    }
                },
            	password: {          
				validators: {
							notEmpty: {
								message: 'Please enter a password'
							},
							securePassword: {
								message: 'The password is not valid'
							}
						}
					},
				password_confirmation: {
                validators: {
					notEmpty: {
								message: 'Please confirm your password'
							},
                    identical: {
                        field: 'password',
                        message: 'The passwords do not match'
						}
					}
				},
				email: {          
				validators: {
							notEmpty: {
							  message: 'Please enter the email address'
							},
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
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
         <?php endif; ?>

    <?php echo e(Form::open(array('id'=>'userform','url' => 'users'))); ?>

<div class="box-body">
    <div class="form-group">
        <?php echo e(Form::label('name', 'Name')); ?>

        <?php echo e(Form::text('name', '', array('class' => 'form-control'))); ?>

    </div>
    <div class="form-group">
        <?php echo e(Form::label('username', 'Username')); ?>

        <?php echo e(Form::text('username', '', array('class' => 'form-control'))); ?>

    </div>

    <div class="form-group">
        <?php echo e(Form::label('email', 'Email')); ?>

        <?php echo e(Form::email('email', '', array('class' => 'form-control'))); ?>

    </div>
	<h2>Assign Group</h2>
    <div class='form-group'>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e(Form::checkbox('roles[]',  $role->id, null, ['id' => 'role'.$role->id] )); ?>

            <?php echo e(Form::label($role->name, ucfirst($role->display_name))); ?><br>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
	<div class="form-group hidden" id="hub">
        <?php echo e(Form::label('hubid', 'Hub')); ?>

        <?php echo e(Form::select('hubid', $hubs, null, ['class' => 'form-control'])); ?>

    </div>
    <div class="form-group hidden" id="hr">
        <?php echo e(Form::label('healthregionid', 'Health Region')); ?>

        <?php echo e(Form::select('healthregionid', $healthregions, null, ['class' => 'form-control'])); ?>

    </div>
    <div class="form-group">
        <?php echo e(Form::label('password', 'Password')); ?><br>
        <?php echo e(Form::password('password', array('class' => 'form-control'))); ?>


    </div>

    <div class="form-group">
        <?php echo e(Form::label('password', 'Confirm Password')); ?><br>
        <?php echo e(Form::password('password_confirmation', array('class' => 'form-control'))); ?>


    </div>
</div>
              <!-- /.box-body -->
              <div class="box-footer">
              <a class="btn btn-sm btn-danger" href="<?php echo e(URL::previous()); ?>">Cancel</a>
    <?php echo e(Form::submit('Add User', array('class' => 'btn btn-sm btn-info pull-right'))); ?>


    <?php echo e(Form::close()); ?>

</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>