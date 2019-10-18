
<?php $__env->startSection('title', 'View Routing Schedule'); ?>

<?php $__env->startSection('content'); ?>
<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
  <div class="col-xs-12 table-responsive">
     <?php if(count($mondayschedule)): ?><table class="table table-bordered">
   
    	<thead>
        	<td>Monday</td>
            <td>Tuesday</td>
            <td>Wednesday</td>
            <td>Thursday</td>
            <td>Friday</td>
            <td>Saturday</td>
            <td>Sunday</td>
        </thead>
      <tbody>
      <tr>
          <td>
          		<ul class="nav nav-pills nav-stacked">
                <?php $__currentLoopData = $mondayschedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($schedule->facility->name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
          	<?php endif; ?>
          </td>
          <td><?php if(count($tuesdayschedule)): ?>
          		<ul class="nav nav-pills nav-stacked">
                <?php $__currentLoopData = $tuesdayschedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($schedule->facility->name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
          	<?php endif; ?>
          </td>
          <td><?php if(count($wednesdayschedule)): ?>
          		<ul class="nav nav-pills nav-stacked">
                <?php $__currentLoopData = $wednesdayschedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($schedule->facility->name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
          	<?php endif; ?>
          </td>
          <td><?php if(count($thursdayschedule)): ?>
          		<ul class="nav nav-pills nav-stacked">
                <?php $__currentLoopData = $thursdayschedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($schedule->facility->name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
          	<?php endif; ?>
          </td>
          <td><?php if(count($fridayschedule)): ?>
          		<ul class="nav nav-pills nav-stacked">
                <?php $__currentLoopData = $fridayschedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($schedule->facility->name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
          	<?php endif; ?>
          </td>
          <td><?php if(count($saturdayschedule)): ?>
          		<ul class="nav nav-pills nav-stacked">
                <?php $__currentLoopData = $saturdayschedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($schedule->facility->name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
          	<?php endif; ?>
          </td>
          <td><?php if(count($sundayschedule)): ?>
          		<ul class="nav nav-pills nav-stacked">
                <?php $__currentLoopData = $sundayschedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($schedule->facility->name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
          	<?php endif; ?>
          </td>
        </tr>
        
      </tbody>
    </table>
    </div>
  </div>
   <div class="box-footer"> 
  <?php if(count($mondayschedule) || count($tuesdayschedule) || count($wednesdayschedule) || count($thursdayschedule) || count($fridayschedule) || count($saturdayschedule) || count($sundayschedule)): ?>
  <a class="btn btn-default" href="<?php echo e(URL::previous()); ?>">Back</a> <a class="btn btn-warning pull-right" href="<?php echo e(route('routingschedule.edit', ['id' => $id])); ?>">Update Schedule</a>
  <?php else: ?>
  <a class="btn btn-default" href="<?php echo e(URL::previous()); ?>">Cancel</a> <a class="btn btn-primary pull-right" href="<?php echo e(route('routingschedule.create')); ?>">Create Schedule</a>
  <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>