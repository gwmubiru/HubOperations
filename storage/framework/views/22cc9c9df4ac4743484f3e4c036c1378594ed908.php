<?php $__env->startSection('title', 'Samples'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
<?php $__env->appendSection(); ?>
<?php $__env->startSection('listpagejs'); ?> 
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script> 
<script>
	$(document).ready(function() {
		$('#listtable').DataTable();
		$('.filter-date').datepicker({
		   format: 'mm/dd/yyyy',
		   endDate: '+0d',
		   autoclose: true
		});
		
		$(".sample").click(function(){
			var sampleid = $(this).attr('id');
			$('#samplemodal_' + sampleid).modal('show');
		});
				
	} );
	
</script> 
<?php $__env->appendSection(); ?>
<style>
	#searchbutton{
		margin-top: -4px;
	}
	.input-field{
		width:100px;
	}
	.selectdropdown{
		width:200px;
	}
	.input-field, .selectdropdown {
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
        border-top-color: rgb(204, 204, 204);
        border-right-color: rgb(204, 204, 204);
        border-bottom-color: rgb(204, 204, 204);
        border-left-color: rgb(204, 204, 204);
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
</style>
<div class="box box-info">

  
  <!-- /.box-header -->
  <?php echo e(Form::open(array('route' => 'samples.processreceipt', 'class' => 'form-horizontal', 'id' => 'hubform'))); ?>

  <div class="box-body table-responsive">
    <table  class="table table-striped table-bordered">
      <thead>
        <tr>
            <th>Envelope ID</th>
            <th>Number of Samples</th>
        </tr>
      </thead>
      <tbody>      
      <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
      
        <td>       
           <?php echo e($package->barcode); ?>    
        </td>
        <td>
          <input type="text" value="" name="packages[<?php echo e($package->id); ?>][number_of_samples]">
          <input type="hidden" value="<?php echo e($package->id); ?>" name="packages[<?php echo e($package->id); ?>][small_package_id]">
           <input type="hidden" value="<?php echo e($id); ?>" name="big_package_id">
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td></td>
        <td><?php echo e(Form::submit('Submit', array('class' => 'btn btn-info '))); ?></td>
      </tr>
        </tbody>      
    </table>
  </div>
  <?php echo e(Form::close()); ?>

  <!-- /.box-body --> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>