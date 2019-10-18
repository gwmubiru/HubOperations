


<?php $__env->startSection('title', 'Roles'); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<?php $__env->appendSection(); ?>
<?php $__env->startSection('listpagejs'); ?>
<script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
    <script>
		$(document).ready(function() {
			$('#roles-table').DataTable();
			
		} );
	</script>
<?php $__env->appendSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="box box-info">

    <div class="box-body table-responsive">
        <table id="roles-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>

                    <td><?php echo e($role->display_name); ?></td>

                    <td><ul><?php $__currentLoopData = $role->perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        				<li><?php echo e($permission->display_name); ?></li>
    					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></td>
                    <td>
                    <a href="<?php echo e(URL::to('roles/'.$role->id.'/edit')); ?>" class=""><i class="fa fa-fw fa-edit"></i> Update</a>
					<a href="<?php echo e(route('roles.destroy', $role->id )); ?>"><i class="fa fa-fw fa-trash-o"></i>Delete</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>

        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>