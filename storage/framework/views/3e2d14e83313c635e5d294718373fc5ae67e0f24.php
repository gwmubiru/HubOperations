<?php $__env->startSection('title', 'Permissions'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<?php $__env->appendSection(); ?>
<?php $__env->startSection('listpagejs'); ?>
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
    <script>
		$(document).ready(function() {
			$('#permisions-table').DataTable();
			
		} );
	</script>
<?php $__env->appendSection(); ?>
<?php $__env->startSection('content'); ?>
   <div class="box box-info">

    <div class="box-body table-responsive">
        <table id="permisions-table" class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($permission->display_name); ?></td> 
                    <td>
                    <a href="<?php echo e(URL::to('permissions/'.$permission->id.'/edit')); ?>"><i class="fa fa-fw fa-edit"></i> Edit</a>
					<a href="<?php echo e(URL::to('permissions/'.$permission->id.'/destroy')); ?>"><i class="fa fa-fw fa-trash-o"></i> Delete</a>
                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]); ?>

                    <?php echo Form::close(); ?>


                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>