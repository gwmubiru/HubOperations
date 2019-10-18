

<?php $__env->startSection('title', 'View '.$hub->hubname.' Details'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
<?php $__env->appendSection(); ?>
<?php $__env->startSection('listpagejs'); ?>
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.stickytabs.js')); ?>"></script>
    <script>
		
		$(document).ready(function() {
			$('#facilitylist').DataTable();
			$('.nav-tabs').stickyTabs();
		} );
		$(function() {
	var options = { 
			selectorAttribute: "data-target",
			backToTop: true
		};
		$('.nav-tabs').stickyTabs( options );
	});
	</script>
<?php $__env->appendSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="box tabbed-view">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
  	<div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Hub Details</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Facilities Served (<?php echo e(count($facilities)); ?>)</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Techinical Team</a></li>
        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Routing Schedule</a></li>
        
        <li class="pull-right">
                <a class="dropdown-toggle text-muted" data-toggle="dropdown" href="#" aria-expanded="false">
                  <i class="fa fa-gear"></i>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" target="_blank" tabindex="-1" href="<?php echo e(route('download.hubinfo', ['hubid' => $hub->id, 'type' => 1])); ?>">Download for App</a></li>
                    
                </ul>
              </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="col-xs-12 table-responsive">
    <table class="table">
      <tbody>
      <tr>
          <td>Name</td>
          <td><?php echo e($hub->hubname); ?></td>
        </tr>
        <tr>
          <td>IP</td>
          <td><?php if($hub->ipid): ?><?php echo e($hub->ip->name); ?><?php endif; ?></td>
        </tr>
      	<tr>
          <td>Health Region</td>
          <td><?php if($hub->ipid): ?><?php echo e($hub->ip->healthregion->name); ?><?php endif; ?></td>
        </tr>
         <tr>
          <td>Code</td>
          <td><?php if($hub->code): ?><?php echo e($hub->code); ?><?php endif; ?></td>
        </tr>        
      </tbody>
    </table>
    <div class="box-footer clearfix"> <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-left">Back</a>
              
                    <a href="<?php echo e(route('hub.edit', $hub->id)); ?>" class="btn btn-warning pull-right">Update Hub</a></div>
    </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
        	<div class="box-body table-responsive">
    <table id="facilitylist" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>District</th>
          <th>Level</th>
          <?php if($can_update_facility || $can_delete_facility): ?>
          <th>Actions</th>
          <?php endif; ?>
        </tr></thead>
        <tbody>
      <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        
        <td><a href="<?php echo e(route('facility.show', $facility->id )); ?>"><?php echo e($facility->name); ?></a></td>
        <td><?php echo e($facility->district); ?></td>
        <td><?php echo e($facility->facilitylevel); ?></td>
        <?php if($can_update_facility || $can_delete_facility): ?>
        <td>
        <?php if($can_update_facility): ?><a href="<?php echo e(route('facility.edit', $facility->id )); ?>"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        <a href="<?php echo e(route('facility.printqr', $hub->id)); ?>" target="_blank"><i class="fa fa-fw fa-qrcode"></i> Print QR code</a>
        
        <?php endif; ?>
        <?php if($can_delete_facility): ?>
        	&nbsp;<a href="<?php echo e(route('facility.edit', $facility->id )); ?>"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
            <?php endif; ?>
        </td>
        <?php endif; ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
  </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">In-Charge</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  <?php if($incharge): ?>
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td><?php echo e($incharge->firstname.' '.$incharge->lastname.' '.$incharge->othernames); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td><?php echo e($incharge->telephonenumber); ?></td>
                        </tr>
                        <?php if(!empty($incharge->phone2)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number2</td>
                          <td><?php echo e($incharge->phone2); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($incharge->phone3)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number3</td>
                          <td><?php echo e($incharge->phone3); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($incharge->phone4)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number4</td>
                          <td><?php echo e($incharge->phone4); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td><?php echo e($incharge->emailaddress); ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                     <?php else: ?>
                    <p class="no-contact">You do not have any in-charge contact. Please click the button below to to add one.</p>
                    <?php endif; ?>
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?php if(!$incharge): ?><a href="<?php echo e(url('contact/new/category/2/type/1/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a><?php else: ?> 
                <a href="<?php echo e(url('contact/new/category/2/type/1/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="<?php echo e(route('contact.edit', $incharge->id)); ?>" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> <?php endif; ?></div>
                <!-- /.box-footer --> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Hub Cordinator</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  <?php if($hubcordinator): ?>
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td><?php echo e($hubcordinator->firstname.' '.$hubcordinator->lastname.' '.$hubcordinator->othernames); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td><?php echo e($hubcordinator->telephonenumber); ?></td>
                        </tr>
                        <?php if(!empty($hubcordinator->phone2)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number2</td>
                          <td><?php echo e($hubcordinator->phone2); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($hubcordinator->phone3)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number3</td>
                          <td><?php echo e($hubcordinator->phone3); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($hubcordinator->phone4)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number4</td>
                          <td><?php echo e($hubcordinator->phone4); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td><?php echo e($hubcordinator->emailaddress); ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                    <?php else: ?>
                    <p class="no-contact">You do not have any hub coordinator contact. Please click the button below to to add one.</p>
                    <?php endif; ?>
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?php if(!$hubcordinator): ?><a href="<?php echo e(url('contact/new/category/2/type/2/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a><?php else: ?> 
                <a href="<?php echo e(url('contact/new/category/2/type/2/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="<?php echo e(route('contact.edit', $hubcordinator->id)); ?>" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> <?php endif; ?></div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
          <div class="row mid-row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Lab Manager</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  <?php if($labmanager): ?>
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td><?php echo e($labmanager->firstname.' '.$labmanager->lastname.' '.$labmanager->othernames); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td><?php echo e($labmanager->telephonenumber); ?></td>
                        </tr>
                        <?php if(!empty($labmanager->phone2)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number2</td>
                          <td><?php echo e($labmanager->phone2); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($labmanager->phone3)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number3</td>
                          <td><?php echo e($labmanager->phone3); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($labmanager->phone4)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number4</td>
                          <td><?php echo e($labmanager->phone4); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td><?php echo e($labmanager->emailaddress); ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                     <?php else: ?>
                    <p class="no-contact">You do not have any lab manager contact. Please click the button below to to add one.</p>
                    <?php endif; ?>
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?php if(!$labmanager): ?><a href="<?php echo e(url('contact/new/category/2/type/3/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a><?php else: ?> 
                <a href="<?php echo e(url('contact/new/category/2/type/3/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="<?php echo e(route('contact.edit', $labmanager->id)); ?>" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> <?php endif; ?></div>
                <!-- /.box-footer --> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">VL Focal Person</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  <?php if($vlfocalperson): ?>
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td><?php echo e($vlfocalperson->firstname.' '.$vlfocalperson->lastname.' '.$vlfocalperson->othernames); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td><?php echo e($vlfocalperson->telephonenumber); ?></td>
                        </tr>
                        <?php if(!empty($vlfocalperson->phone2)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number2</td>
                          <td><?php echo e($vlfocalperson->phone2); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($vlfocalperson->phone3)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number3</td>
                          <td><?php echo e($vlfocalperson->phone3); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($vlfocalperson->phone4)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number4</td>
                          <td><?php echo e($vlfocalperson->phone4); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td><?php echo e($vlfocalperson->emailaddress); ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                     <?php else: ?>
                    <p class="no-contact">You do not have any VL focal person contact. Please click the button below to to add one.</p>
                    <?php endif; ?>
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?php if(!$vlfocalperson): ?><a href="<?php echo e(url('contact/new/category/2/type/4/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a><?php else: ?> 
                <a href="<?php echo e(url('contact/new/category/2/type/4/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="<?php echo e(route('contact.edit', $labmanager->id)); ?>" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> <?php endif; ?></div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
          <div class="row mid-row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">EID Focal Person</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  <?php if($eidfocalperson): ?>
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td><?php echo e($eidfocalperson->firstname.' '.$eidfocalperson->lastname.' '.$eidfocalperson->othernames); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td><?php echo e($eidfocalperson->telephonenumber); ?></td>
                        </tr>
                        <?php if(!empty($eidfocalperson->phone2)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number2</td>
                          <td><?php echo e($eidfocalperson->phone2); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($eidfocalperson->phone3)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number3</td>
                          <td><?php echo e($eidfocalperson->phone3); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($eidfocalperson->phone4)): ?>
                        <tr>
                          <td class="contact-label">Telephone Number4</td>
                          <td><?php echo e($eidfocalperson->phone4); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td><?php echo e($eidfocalperson->emailaddress); ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                     <?php else: ?>
                    <p class="no-contact">You do not have any lab EID focal person. Please click the button below to to add one.</p>
                    <?php endif; ?>
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?php if(!$eidfocalperson): ?><a href="<?php echo e(url('contact/new/category/2/type/5/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a><?php else: ?> 
                <a href="<?php echo e(url('contact/new/category/2/type/5/obj', ['obj' => $hub->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="<?php echo e(route('contact.edit', $labmanager->id)); ?>" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> <?php endif; ?></div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_4">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
  <div class="col-xs-12 table-responsive">
   <?php if(count($mondayschedule) || count($tuesdayschedule) || count($wednesdayschedule) || count($thursdayschedule) || count($fridayschedule) || count($saturdayschedule) || count($sundayschedule)): ?>
   <?php if(count($mondayschedule)): ?> 
   <table class="table table-bordered">
    
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
    <?php else: ?>
   <p>This hub has not yet added their routing schedule. Follow-up with them, or create for them one by clicking of the "Create Schedule" button below.
    <?php endif; ?>
    </div>
  </div>
   <div class="box-footer"> 
  <?php if(count($mondayschedule) || count($tuesdayschedule) || count($wednesdayschedule) || count($thursdayschedule) || count($fridayschedule) || count($saturdayschedule) || count($sundayschedule)): ?>
  
  <?php else: ?>
   <a class="btn btn-primary pull-right" href="<?php echo e(route('routingschedulecreate', ['id' => $hub->id])); ?>">Create Schedule</a>
  <?php endif; ?>
  </div>
</div>
              
            </div>
          </div>
          
        </div> 
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content --> 
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>