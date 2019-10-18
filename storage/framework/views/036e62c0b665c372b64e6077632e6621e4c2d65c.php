<?php $__env->startSection('title', 'All Facilities'); ?>
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

<div class="box box-info">
  
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="facilitylist" class="table table-striped table-bordered display">
      <thead>
        <tr>
          <th>Name</th>
          <th>Hub</th>
          <th>District</th>
          <th>Level</th>
           <th>Actions</th>

        </tr></thead>
        <tbody>
      <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td><a href="<?php echo e(route('facility.show', $facility->id )); ?>"><?php echo e($facility->name); ?></a></td>
        <td><?php echo e($facility->hub); ?></td>
        <td><?php echo e($facility->district); ?></td>
        <td><?php echo e($facility->facilitylevel); ?></td>
        <td><?php if(Entrust::can('Update_facility')): ?><a href="<?php echo e(route('facility.edit', $facility->id )); ?>"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;<?php endif; ?>
        <a href="<?php echo e(route('facility.printqr', $facility->id)); ?>" target="_blank"><i class="fa fa-fw fa-qrcode"></i> Print QR code</a>
        <?php if($can_delete_facility): ?>
       &nbsp;<a href="<?php echo e(route('facility.edit', $facility->id )); ?>"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
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