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
          <th>Actions</th> 
        </tr>
      </thead>
      <tbody>
      
      <?php $__currentLoopData = $equipment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <tr>
       
        <td><a href="<?php echo e(route('equipment.show', $eq->id )); ?>"><?php echo e($eq->numberplate); ?></a></td>
        <td class="bikestate<?php echo e($eq->status); ?>"><?php echo e($eq->hubname); ?></td>
        <td class="bikestate<?php echo e($eq->status); ?>"><?php echo e($eq->enginenumber); ?></td>
        <td class="bikestate<?php echo e($eq->status); ?>"><?php echo e($eq->yearofmanufacture); ?></td> 
        <td><?php if (\Entrust::hasRole('Admin','national_hub_coordinator')) : ?><a href="<?php echo e(route('equipment.edit', $eq->id )); ?>"><i class="fa fa-fw fa-edit"></i>Update</a>&nbsp;
        	<a href="<?php echo e(route('equipment.destroy', $eq->id )); ?>"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
        <?php endif; // Entrust::hasRole ?>
        <?php if (\Entrust::hasRole('hub_coordinator')) : ?>
        	<?php if($eq->status == 1): ?>
           		 <a href="<?php echo e(route('equipment.breakdown',['hubid' => $eq->hubid, 'id' => $eq->id])); ?>" class="text-muted btn-sm btn btn-danger"><i class="fa fa-gear"></i> Report Break Down</a>
            <?php else: ?>
             <a class="btn btn-sm btn-info text-muted" href="javascript:void(0)"
                            data-toggle="modal" data-target="#status-update<?php echo e($eq->id); ?>">
                      <span class="fa fa-thumbs-o-up"></span>
                            Mark bike fixed</a>
                       <div class="modal fade" tabindex="-1" role="dialog" id="status-update<?php echo e($eq->id); ?>">
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
            <?php echo e(Form::hidden('breakdownid', $eq->breakdownid)); ?>

            <?php echo e(Form::hidden('equipmentid', $eq->id)); ?>

            <?php echo e(Form::submit('Report bike as fixed', array('class' => 'btn btn-info pull-right'))); ?> </div>
          <!-- /.box-footer --> 
          
          <?php echo e(Form::close()); ?> </div>
  		</div> 
      </div>
     </div>
    </div>
            <?php endif; ?>

        <?php endif; // Entrust::hasRole ?>
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