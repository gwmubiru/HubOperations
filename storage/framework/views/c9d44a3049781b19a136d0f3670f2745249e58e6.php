<?php $__env->startSection('title', 'View Bike Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Bike Details</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Bike Break Down</a></li>
        <li class="pull-right"><a href="<?php echo e(url('equipment/down/hubid/'.$equipment->hub->id.'/id/'.$equipment->id)); ?>" class="text-muted btn btn-primary"><i class="fa fa-gear"></i> Report Break Down</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="col-xs-12 table-responsive bikestate<?php echo e($equipment->status); ?>">
            <table class="table view">
              <tbody>
                <tr class="first-row">
                  <td>Number Plate</td>
                  <td><?php echo e($equipment->numberplate); ?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td><?php echo e(getLookupValueDescription("EQUIPMENT_STATUS", $equipment->status)); ?>

                  <?php if($equipment->status == 2): ?><br />
                  <a class="btn btn-sm btn-info" href="javascript:void(0)"
                        data-toggle="modal" data-target="#status-update">
                  <span class="fa fa-thumbs-o-up"></span>
                        Mark bike fixed</a>
                  <?php endif; ?>
 </td>
                </tr>
                <tr>
                  <td>Engine Number</td>
                  <td><?php echo e($equipment->enginenumber); ?></td>
                </tr>
                <tr>
                  <td>Chasis Number</td>
                  <td><?php echo e($equipment->chasisnumber); ?></td>
                </tr>
                <tr>
                  <td>Year of Manufacture</td>
                  <td><?php echo e($equipment->yearofmanufacture); ?></td>
                </tr>
                <tr>
                  <td>Color</td>
                  <td><?php echo e($equipment->color); ?></td>
                </tr>
                <tr>
                  <td>Model Number</td>
                  <td><?php echo e($equipment->modelnumber); ?></td>
                </tr>
                <tr>
                  <td>Brand</td>
                  <td><?php echo e($equipment->brand); ?></td>
                </tr>
                <tr>
                  <td>Engine Capacity</td>
                  <td><?php echo e($equipment->enginecapacity); ?></td>
                </tr>
                <tr>
                  <td>Insurance</td>
                  <td><?php echo e($equipment->insurance); ?></td>
                </tr>
                <tr>
                  <td>Hub</td>
                  <td><?php echo e($equipment->hub->name); ?></td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3"> 
        <div class="box box-info" style="border:none;">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
        	<?php if($reasons_for_breakdown): ?>
            <div class="row">
            	<div class="col-md-12">
                <h2 class="section">Reasons for breakdown</h2>
                	<ul>
                    	<?php $__currentLoopData = $reasons_for_breakdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        	<li><?php echo e(getLookupValueDescription("BIKE_DOWN_REASONS", $reason->reason)); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
             </div>
            <?php endif; ?>
            
            
            <div class="row">
            	<div class="col-md-12"><?php if($breakdown_action_taken): ?>
                	<h2 class="section">Actions taken</h2>
                	<ul>
                    	<?php $__currentLoopData = $breakdown_action_taken; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        	<li><?php echo e(getLookupValueDescription("BIKE_BREAK_DOWN_ACTIONS", $action->action)); ?>

                            <?php if($action->action == 1): ?>
                            	<h3>Mechanic Details</h3>
                                	<p><span>Name: </span><?php echo e($equipment->breakdown->mechanic->getFullName()); ?></p>
                                    <p><span>Telephone: </span><?php echo e($equipment->breakdown->mechanic->telephonenumber); ?></p>
                                    <p><span>Email: </span><?php echo e($equipment->breakdown->mechanic->emailaddress); ?></p>
                                
                            <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php else: ?>
                    <p>Currently this bike is in good working condition. To view previous history of breakdown, click here.</p>
                    <?php endif; ?>
                </div>
             </div>
            
            <?php if($breakdown_action_taken): ?>
             <div class="box-footer" style="border:none;">
                <a class="btn btn-info pull-right" href="<?php echo e(URL::previous()); ?>">View all Break Down History</a></button>
            </div>
            <?php endif; ?>
        </div> <!-- /.box-body -->
        </div>
        
        <!-- /.tab-pane --> 
      </div>
      <!-- /.tab-content --> 
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="status-update">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Bike Now in Normal State</h4>
      </div>
      <div class="modal-body">
      	<div class="box box-info no-border"> 
      	<?php echo e(Form::open(array('url' => 'equipment/updatebreakdownstatus', 'class' => 'form-horizontal', 'id' => 'breakdown'))); ?>

  <?php echo e(csrf_field()); ?>

  
  			<div class="form-group">
              <label for="datebrokendown" class="col-sm-3 control-label"><?php echo e(Form::label('closingnotes', 'Any Notes')); ?></label>
              <div class="col-sm-9">
                <?php echo e(Form::textarea('closingnotes', null, array('class' => 'form-control', 'id' => 'closingnotes', 'placeholder' => 'Enter remarks on how this bike breakdown was fixed'))); ?>

              </div>
            </div>
  			<div class="box-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </button>
            <?php echo e(Form::hidden('breakdownid', $equipment->breakdownid)); ?>

            <?php echo e(Form::hidden('equipmentid', $equipment->id)); ?>

            <?php echo e(Form::submit('Report bike as fixed', array('class' => 'btn btn-info pull-right'))); ?> </div>
          <!-- /.box-footer --> 
          
          <?php echo e(Form::close()); ?> </div>
  		</div> 
      </div>
     </div>
    </div>
  </div>
      
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>