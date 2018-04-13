	<?php $__env->startSection('title', 'View User: '.$user->name); ?>
<?php $__env->startSection('content'); ?>
<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
  <div class="col-xs-12 table-responsive">
    <table class="table">
      <tbody>
        <tr>
          <td>Name</td>
          <td><?php echo e($user->name); ?></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><?php echo e($user->username); ?></td>
        </tr>
        <tr>
          <td>Email </td>
          <td><?php echo e($user->email); ?></td>
        </tr>
       
      </tbody>
    </table>
    </div>
    <div class="box-footer clearfix">  
                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-default pull-left">Back</a>
                <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-sm btn-warning pull-right">Update User</a> </div>
  </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>