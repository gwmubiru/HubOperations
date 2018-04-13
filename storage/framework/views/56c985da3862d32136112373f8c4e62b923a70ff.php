<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
<?php $__env->appendSection(); ?>
<?php $__env->startSection('js'); ?> 
<script>
$(document).ready(function() {
} );

</script> 
<?php $__env->appendSection(); ?>
<?php $__env->startSection('content'); ?>
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
  <section class="content"> 
    <div class="row"> 
      <!-- Left col -->
      <section class="col-lg-6"> 
      <h2>Total No. Samples</h2>
         <div id="stocks-chart" >
    <?php echo lava::render('LineChart', 'MyStocks', 'stocks-chart'); ?></div>
      </section>
       <section class="col-lg-6"> 
       <h2 style="margin-bottom:47px;">Summary</h2>
         <div class="table-responsive">
         	<table class="table table-bordered">
            	<tr>
                	<?php $__currentLoopData = $samples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($line->sampletype); ?>

                    </th>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
                </tr>
                <tr>
                	<?php $__currentLoopData = $samples; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($line->samples); ?>

                    </td>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </table>
         </div>
      </section>
     </div>
     
     
     
     <div class="row"> 
      <!-- Left col -->
      <section class="col-lg-6"> 
      <h2>Total No. Results</h2>
         <div id="results-chart" >
    <?php echo lava::render('LineChart', 'theresults', 'results-chart'); ?></div>
      </section>
       <section class="col-lg-6"> 
       <h2 style="margin-bottom:47px;">Summary</h2>
         <div class="table-responsive">
         	<table class="table table-bordered">
            	<tr>
                	<?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($line->resulttype); ?>

                    </th>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
                </tr>
                <tr>
                	<?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($line->results); ?>

                    </td>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </table>
         </div>
      </section>
     </div>
     
  </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>