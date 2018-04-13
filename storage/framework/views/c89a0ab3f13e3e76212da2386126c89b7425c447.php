<?php $__env->startSection('title', 'View All Bikes'); ?>
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
<style>
	div.dataTables_length label {
    font-weight: normal;
    float: left;
    text-align: left;
    margin-bottom: 0;
}
div.dataTables_length select {
    min-width: 60px;
    margin-right: 4px;
}
</style>
<div class="box box-info"> 
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="listtable" class="table table-striped table-bordered">
      <thead>
        <tr>        
         
          <th>Number Plate</th>
          <th>Hub</th>
          <th>Engine Number</th>
          <th>Year of Manufacture</th> 
          <?php if (\Entrust::hasRole('Admin','Program_officer')) : ?> <th>Actions</th> <?php endif; // Entrust::hasRole ?>
        </tr>
      </thead>
      <tbody>
      
      <?php $__currentLoopData = $equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr class="bikestate<?php echo e($eq->status); ?>">
       
        <td><a href="<?php echo e(route('equipment.show', $eq->id )); ?>"><?php echo e($eq->numberplate); ?></a></td>
        <td><?php echo e($eq->hub); ?></td>
        <td><?php echo e($eq->enginenumber); ?></td>
        <td><?php echo e($eq->yearofmanufacture); ?></td> <?php if (\Entrust::hasRole('Admin','Program_officer')) : ?><td><a href="<?php echo e(route('equipment.edit', $eq->id )); ?>"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="<?php echo e(route('equipment.destroy', $eq->id )); ?>"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
        </td><?php endif; // Entrust::hasRole ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      
    </table>
  </div>
  <!-- /.box-body --> 
  
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>