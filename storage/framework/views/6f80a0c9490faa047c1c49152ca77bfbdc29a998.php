<?php $__env->startSection('title', 'View IP'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" />
<?php $__env->appendSection(); ?>
<?php $__env->startSection('listpagejs'); ?>
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/buttons.colVis.min.js')); ?>"></script>
    <script>
		$(document).ready(function() {
			//$('#facilitylist').DataTable();
			/*$('#facilitylist').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'excelHtml5',
					'pdfHtml5'
				]
			} );*/
			 $('#facilitylist').DataTable( {
				dom: 'Bflrtip',
				buttons: [
					
					{
						extend: 'excelHtml5',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'pdfHtml5',
						exportOptions: {
							columns: ':visible'
						}
					},
					'colvis'
				]
			} );
		} );
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
        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">IP Details</a></li>
        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Hubs Served</a></li>
        <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Techinical Team</a></li>
        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="col-xs-12 table-responsive">
            <table class="table">
              <tbody>
                <tr class="first-row">
                  <td>Name</td>
                  <td><?php echo e($organization->name); ?></td>
                </tr>
                <tr>
                  <td>Health Region</td>
                  <td><?php if($organization->healthregionid): ?><?php echo e($organization->healthregion->name); ?><?php endif; ?></td>
                </tr>
                <tr>
                  <td>Telephone</td>
                  <td><?php echo e($organization->telephonenumber); ?></td>
                </tr>
                <tr>
                  <td>Email Address</td>
                  <td><?php echo e($organization->emailaddress); ?></td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td><?php echo e($organization->address); ?></td>
                </tr>
                <tr>
                  <td>Support Agency</td>
                  <td><?php if($organization->supportagencyid): ?><?php echo e($organization->supportagency->name); ?><?php endif; ?></td>
                </tr>
                <tr>
                  <td>Support Period</td>
                  <td>From <?php echo e(date('d/m/Y', strtotime($supportperiod[0]->startdate))); ?> to <?php echo e(date('d/m/Y', strtotime($supportperiod[0]->enddate))); ?></td>
                </tr>
              </tbody>
            </table>
          </div>
              <div class="box-footer clearfix"> <a href="<?php echo e(URL::previous()); ?>" class="btn btn-default pull-left">Back</a>
              
                    <a href="<?php echo e(route('organization.edit', $organization->id)); ?>" class="btn btn-warning pull-right">Update IP</a></div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
        	<div class="box-body table-responsive">
    <table id="facilitylist" class="table table-striped table-bordered display">
      <thead>
        <tr>
          <th>Name</th>
          <th>Hub</th>
          <th>District</th>
          <th>Level</th>

        </tr></thead>
        <tbody>
      <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><a href="<?php echo e(route('facility.show', $facility->id )); ?>"><?php echo e($facility->name); ?></a></td>
        <td><?php echo e($facility->hub); ?></td>
        <td><?php echo e($facility->district); ?></td>
        <td><?php echo e($facility->facilitylevel); ?></td>
       
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
                  <h3 class="box-title">Care & Treat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  <?php if($careandtreat): ?>
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td><?php echo e($careandtreat->firstname.' '.$careandtreat->lastname.' '.$careandtreat->othernames); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td><?php echo e($careandtreat->telephonenumber); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td><?php echo e($careandtreat->emailaddress); ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                     <?php else: ?>
                    <p class="no-contact">You do not have any Care and Treat contact. Please click the button below to to add one.</p>
                    <?php endif; ?>
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?php if(!$careandtreat): ?><a href="<?php echo e(url('contact/new/category/1/type/1/obj', ['obj' => $organization->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a><?php else: ?> 
                <a href="<?php echo e(url('contact/new/category/1/type/1/obj', ['obj' => $organization->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="<?php echo e(route('contact.edit', $careandtreat->id)); ?>" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> <?php endif; ?></div>
                <!-- /.box-footer --> 
              </div>
            </div>
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Lab Technitian</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  <?php if($labtech): ?>
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td><?php echo e($labtech->firstname.' '.$labtech->lastname.' '.$labtech->othernames); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td><?php echo e($labtech->telephonenumber); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td><?php echo e($labtech->emailaddress); ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                    <?php else: ?>
                    <p class="no-contact">You do not have any Lab tech contact. Please click the button below to to add one.</p>
                    <?php endif; ?>
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?php if(!$labtech): ?><a href="<?php echo e(url('contact/new/category/1/type/2/obj', ['obj' => $organization->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Add Contact</a><?php else: ?> 
                <a href="<?php echo e(url('contact/new/category/1/type/2/obj', ['obj' => $organization->id])); ?>" class="btn btn-sm btn-info btn-flat pull-left">Change to New Contact</a>
                <a href="<?php echo e(route('contact.edit', $careandtreat->id)); ?>" class="btn btn-sm btn-warning btn-flat pull-right">Update Contact</a> <?php endif; ?></div>
                <!-- /.box-footer --> 
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">PMTC/EMTC</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	
                  <div class="table-responsive">
                  <?php if($pmtc): ?>
                    <table class="table no-margin">
                      <tbody>
                        <tr class="first-row">
                          <td class="contact-label"> Name</td>
                          <td><?php echo e($pmtc->firstname.' '.$pmtc->lastname); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Telephone Number</td>
                          <td><?php echo e($pmtc->telephonenumber); ?></td>
                        </tr>
                        <tr>
                          <td class="contact-label">Email Address</td>
                          <td><?php echo e($pmtc->emailaddress); ?></td>
                        </tr>
                        
                      </tbody>
                    </table>
                     <?php else: ?>
                    <p class="no-contact">You do not have any Care and Treat contact. Please click the button below to to add one.</p>
                    <?php endif; ?>
                  </div>
                  
                  <!-- /.table-responsive --> 
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix"> <?php if(!$pmtc): ?><a href="<?php echo e(url('contact/new/category/1/type/3/obj', ['obj' => $organization->id])); ?>" class="btn btn-sm btn-info  pull-left">Add Contact</a><?php else: ?> 
                <a href="<?php echo e(url('contact/new/category/1/type/3/obj', ['obj' => $organization->id])); ?>" class="btn btn-sm btn-info  pull-left">Change to New Contact</a>
                <a href="<?php echo e(route('contact.edit', $careandtreat->id)); ?>" class="btn btn-sm btn-warning  pull-right">Update Contact</a> <?php endif; ?></div>
                <!-- /.box-footer --> 
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