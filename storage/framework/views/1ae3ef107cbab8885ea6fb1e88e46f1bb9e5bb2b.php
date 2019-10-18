

<?php $__env->startSection('title', 'View Facility'); ?>

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
          <td><?php echo e($facility->name); ?></td>
        </tr>
        <tr>
          <td>District</td>
          <td><?php echo e($facility->district->name); ?></td>
        </tr>
        <tr>
          <td>Hub</td>
          <td><?php echo e($facility->hub->hubname); ?></td>
        </tr>
        <tr>
          <td>Level</td>
          <td><?php echo e($facility->facilitylevel->level); ?></td>
        </tr>
         <tr>
          <td>Distance from hub</td>
          <td><?php echo e($facility->distancefromhub); ?> KM</td>
        </tr>
        <tr>
          <td>In-charge</td>
          <td><?php echo e($facility->incharge); ?>, <?php echo e($facility->inchargephonenumber); ?></td>
        </tr>
        <tr>
          <td>Lab Manager</td>
          <td><?php echo e($facility->labmanager); ?>, <?php echo e($facility->labmanagerphonenumber); ?></td>
        </tr>
        <?php if (\Entrust::hasRole(['administrator','national_hub_coordinator'])) : ?> 
        <tr>
        	<td></td>
            <td> <a href="<?php echo e(route('facility.printqr', $facility->id)); ?>" target="_blank">Print code</a><?php echo QrCode::generate($facility->id); ?></td>
        </tr>
        <?php endif; // Entrust::hasRole ?>
      </tbody>
    </table>
    </div>
    <div class="box-footer clearfix">  
                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-default pull-left">Back</a>
                <a href="<?php echo e(route('facility.edit', $facility->id)); ?>" class="btn btn-sm btn-warning pull-right">Update Facility</a> </div>
  </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>