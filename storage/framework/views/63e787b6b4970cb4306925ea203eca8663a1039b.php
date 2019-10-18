
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
<div class="well firstrow list">
  <div class="row">
    <?php echo e(Form::open(array('route' => 'samples.cphl', 'class' => 'form-search pull-left', 'id' => 'samplelist'))); ?>

            <?php echo e(csrf_field()); ?>

   <?php echo e(Form::text('from', old('from'), ['class' => 'input-field filter-date', 'id' => 'from', 'placeholder' => 'From'])); ?>

   <?php echo e(Form::text('to', old('to'), ['class' => 'input-field filter-date', 'id' => 'to', 'placeholder' => 'To'])); ?>

   <?php echo e(Form::select('status', $status_dropdown, old('status'), ['class'=>'selectdropdown autosubmitsearchform'])); ?>

   
<?php if (\Entrust::hasRole(['national_hub_coordinator','administrator'])) : ?> 
    <?php echo e(Form::select('hubid', $hubs, old('hubid'), ['class'=>'selectdropdown autosubmitsearchform'])); ?>

    <?php endif; // Entrust::hasRole ?>
   <?php if (\Entrust::hasRole(['national_hub_coordinator','administrator'])) : ?>  
   <?php endif; // Entrust::hasRole ?>
    
   	<button type="submit" id="searchbutton" class="btn btn-primary">Filter <i class="glyphicon glyphicon-filter"></i></button>
    <?php echo e(Form::close()); ?>

   
  </div>
  
</div>
  
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="listtable" class="table table-striped table-bordered">
      <thead>
        <tr>
            <th>Envelope ID</th>
            <th>No.Envelopes</th>
          <th>From</th>
          <th>Picked on</th>
          <th>Status</th>
          <th>Received at</th>
          <?php if (\Entrust::hasRole(['hub_coordinator'])) : ?>
          <th>Action</th>
          <?php endif; // Entrust::hasRole ?>
        </tr>
      </thead>
      <tbody>      
      <?php $__currentLoopData = $samples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sample): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
      <td><?php echo e($sample->barcode); ?></td>
      <td><?php echo e($sample->numberofenvelopes); ?></td>
        <td><?php echo e($sample->hubname); ?></td>
        <td><?php echo e(getPageDateFormat($sample->thedate)); ?></td>
        <td> <?php if($sample->status == 1): ?>
        In transit to CPHL
        <?php elseif($sample->status == 2): ?>
        Delivered to CPHL
        <?php elseif($sample->status == 3): ?>
        Received at CPHL
        <?php else: ?>
       Waiting Pickup 
        <?php endif; ?></td>
        <td><?php if($sample->recieved_at != ''): ?>
        <?php echo e($sample->recieved_at); ?>

        <?php else: ?>
        <?php echo e($sample->delivered_at); ?>

        <?php endif; ?></td>
        <?php if (\Entrust::hasRole(['hub_coordinator'])) : ?>
        <td>       
        <?php if($sample->status == 2 && Auth::user()->hubid = $sample->destinationfacility): ?>   
             
        <?php endif; ?>
        
        </td>
        <?php endif; // Entrust::hasRole ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>      
    </table>
  </div>
  <!-- /.box-body --> 
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>