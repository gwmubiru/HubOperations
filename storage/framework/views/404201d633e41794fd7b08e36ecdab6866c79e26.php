
<?php $__env->startSection('title', 'View All Hubs'); ?>
<?php $__env->startSection('content'); ?>

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
			//$('#listtable').DataTable();
			$('#listtable').DataTable( {
				dom: 'Bfrtip',
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
<div class="box box-info"> 
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="listtable" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>IP(s)</th>
          <th>Health Region</th>
          <th>Resident District</th>
          <th>No.Facilities Served</th>
         <?php if($can_update_facility || $can_delete_facility): ?>
          <th>Actions</th>
          <?php endif; ?> 
        </tr>
      </thead>
      <tbody>
      
      <?php $__currentLoopData = $hubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><a href="<?php echo e(route('hub.show', $hub->id )); ?>"><?php echo e($hub->hubname); ?></a></td>
        <td><?php echo e(getIpsForFacility($hub->id)); ?></td>
        <td><?php echo e($hub->healthregion); ?></td>
        <td><?php echo e($hub->district); ?></td>
        <td><?php echo e(count(getFacilitiesforHub($hub->id))); ?></td>
        <?php if($can_update_facility || $can_delete_facility): ?>
        <td>
        <?php if($can_update_facility): ?><a href="<?php echo e(route('hub.edit', $hub->id )); ?>"><i class="fa fa-fw fa-edit"></i>Update</a> <?php endif; ?>
        &nbsp;
        <a href="<?php echo e(route('facility.printqr', $hub->id)); ?>" target="_blank"><i class="fa fa-fw fa-qrcode"></i> Print QR code</a>
        <?php if($can_delete_facility): ?>
       &nbsp; <a href="<?php echo e(route('hub.destroy', $hub->id )); ?>"><i class=" fa fa-fw fa-trash-o"></i>Delete</a>
        <?php endif; ?></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      
    </table>
  </div>
  <!-- /.box-body --> 
  
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>