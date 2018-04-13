<?php if($pagetype == 1): ?>
	<?php $__env->startSection('title', 'View All Sample Transporters'); ?>
<?php else: ?>
	<?php $__env->startSection('title', 'View All Staff Members'); ?>
<?php endif; ?>

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
          <th>First Name</th>
          <th>Last Name</th>
          <th>Hub</th>
          <?php if($pagetype == 2): ?>
          <th>Designation</th>
          <?php endif; ?>
          <?php if($pagetype == 1): ?>
          <th>Has Driving Permit</th>
          <th>Densive Driving</th>
          <th>Trained in BB</th>
          <th>Is Immunised for HB</th>
          <?php endif; ?>
          
          <th>Actions</th>
        </tr>
    </thead>
      <tbody>
        
      <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><a href="<?php echo e(route('staff.show', $st->id )); ?>"><?php echo e($st->firstname); ?></a></td>
        <td><?php echo e($st->lastname); ?></td>
        <td><?php echo e($st->facility); ?></td>
        <?php if($pagetype == 2): ?>
        <td><?php echo e($st->designation); ?></td>
        <?php endif; ?>
        <?php if($pagetype == 1): ?>
        <td><?php echo e(getLookupValueDescription('YES_NO', $st->hasdrivingpermit)); ?></td>
        <td><?php echo e(getLookupValueDescription('YES_NO', $st->hasdefensiveriding)); ?></td>
        <td><?php echo e(getLookupValueDescription('YES_NO', $st->hasbbtraining)); ?></td>
        <td><?php echo e(getLookupValueDescription('YES_NO', $st->isimmunizedforhb)); ?></td>
        <?php endif; ?>

        <td><a href="<?php echo e(route('staff.edit', $st->id )); ?>"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="<?php echo e(route('staff.destroy', $st->id )); ?>"><i class=" fa fa-fw fa-trash-o"></i>Delete</a>
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