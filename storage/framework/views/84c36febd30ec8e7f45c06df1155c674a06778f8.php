

<?php $__env->startSection('title', 'Add Role'); ?>
<?php $__env->startSection('title', 'Create Permission'); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script>
 <script>
	$(document).ready(function() {
		$('#roleform').bootstrapValidator({
       
			fields: {
				name: {
						validators: {
							notEmpty: {
								message: 'Please enter the permission name'
							}
						}
					},
					'permissions[]': {
						validators: {
							notEmpty: {
								message: 'Please select atleast one permission'
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
  <?php echo e(Form::open(array('url' => 'roles', 'id' => 'roleform'))); ?>

  <div class="box-body">
    <div class="form-group"> <?php echo e(Form::label('name', 'Name')); ?>

      <?php echo e(Form::text('name', null, array('class' => 'form-control'))); ?> </div>
    <h2>Assign Permissions</h2>
    <div class='form-group'> <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php echo e(Form::checkbox('permissions[]',  $permission->id )); ?>

      <?php echo e(Form::label($permission->name, ucfirst($permission->name))); ?><br>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </div>
  </div>
  <!--/box-body -->
  <div class="box-footer"> <a class="btn btn-sm btn-danger" href="<?php echo e(URL::previous()); ?>">Cancel</a> <?php echo e(Form::submit('Add Role', array('class' => 'btn btn-sm btn-info pull-right'))); ?>

    
    <?php echo e(Form::close()); ?> </div>
  <!-- /.box-footer --> 
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>