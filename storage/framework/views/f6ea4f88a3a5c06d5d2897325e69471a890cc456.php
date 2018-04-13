<?php $__env->startSection('title', 'Edit Role: '.$role->name); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('js/bootstrapValidator.min-0.5.1.js')); ?>"></script>
 
<?php $__env->appendSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="box box-info"> <?php if($errors->any()): ?>
  <div class="alert alert-danger">
    <ul>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <li><?php echo e($error); ?></li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
  <?php endif; ?>
  
  <?php echo e(Form::model($role, array('id'=>'roleform','route' => array('roles.update', $role->id), 'method' => 'PUT'))); ?>

  <div class="box-body">
    <div class="form-group"> <?php echo e(Form::label('name', 'Role Name')); ?>

      <?php echo e(Form::text('name', $role->display_name, array('class' => 'form-control'))); ?> </div>
    <h5><b>Assign Permissions</b></h5>
    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e(Form::checkbox('permissions[]',  $permission->id, checkifPermissioninArray($permission->id, $role_permissions))); ?>

    <?php echo e(Form::label($permission->name, ucfirst($permission->display_name))); ?><br>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> </div>
  <!--/box-body -->
  <div class="box-footer"> 
   <a class="btn btn-danger btn-sm" href="<?php echo e(URL::previous()); ?>">Cancel</a>
  <?php echo e(Form::submit('Edit Role', array('class' => 'btn btn-sm btn-warning pull-right'))); ?>

    
    <?php echo e(Form::close()); ?> </div>
  <!-- /.box-footer --> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>