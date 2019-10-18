
<?php $__env->startSection('title', 'View All Ips'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
<?php $__env->appendSection(); ?>
<?php $__env->startSection('listpagejs'); ?> 
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script> 
<script>
		$(document).ready(function() {
			$('#listtable').DataTable();
		} );
	</script> 
<?php $__env->appendSection(); ?>
<div class="box box-info"> 
  
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="listtable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      
      <?php $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><a href="<?php echo e(route('organization.show', $organization->id )); ?>"><?php echo e($organization->name); ?></a></td>
        <td><a href="<?php echo e(route('organization.edit', $organization->id )); ?>"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;  <?php if(Entrust::can('Delete-IP')): ?>
        <a href="<?php echo e(route('organization.destroy', $organization->id )); ?>"><i class=" fa fa-fw fa-trash-o"></i>Delete</a>
        <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      
    </table>
  </div>
  <!-- /.box-body --> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>