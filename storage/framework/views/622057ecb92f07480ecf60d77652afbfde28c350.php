<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      

    <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?php echo e(route('dashboard.index')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <!--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->
       <?php if (\Entrust::hasRole(['administrator','national_hub_coordinator'])) : ?> 
       	<li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Access Control</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="<?php echo e(route('roles.create')); ?>">Create Role</a></li>
           	<li><a href="<?php echo e(route('roles.index')); ?>">View All Roles</a></li>
            <li><a href="<?php echo e(route('permissions.create')); ?>">Create Permission</a></li>
            <li><a href="<?php echo e(route('permissions.index')); ?>">View All Permissions</a></li>
            <li><a href="<?php echo e(route('users.create')); ?>">Create User</a></li>
           	<li><a href="<?php echo e(route('users.index')); ?>">View All Users</a></li>
          </ul>
          
        </li>
       <?php endif; // Entrust::hasRole ?>
       <?php if (\Entrust::can(['view-assessment-list','create-assessment'])) : ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Infrastructure Assessment</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="<?php echo e(route('infrastructure.create')); ?>">Provide Assessment</a></li>
           	<li><a href="<?php echo e(route('infrastructure.index')); ?>">View All Assessment</a></li>
          </ul>          
        </li>
        <?php endif; // Entrust::can ?>
       <?php if (\Entrust::hasRole(['administrator','national_hub_coordinator'])) : ?> 
       <li class="treeview">
          <a href="#"><i class="fa fa-institution"></i> <span>Manage IPs</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="<?php echo e(route('organization.create')); ?>">Add New IP</a></li>
           	<li><a href="<?php echo e(route('organization.index')); ?>">View All IPs</a></li>
          </ul>
          
        </li>
       <li class="treeview">
          <a href="#"><i class="fa fa-hospital-o"></i> <span>Manage Hubs</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="<?php echo e(route('hub.create')); ?>">Add New Hub</a></li>
           	<li><a href="<?php echo e(route('hub.index')); ?>">View All Hubs</a></li>
            <li><a href="<?php echo e(route('hub.assignfacility')); ?>">Assign facilities to Hub</a></li>
          </ul>
          
        </li>
        <li class="treeview">
          <a href="#"><i class="fa  fa-plus"></i> <span>Manage Facilities</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
           	<li><a href="<?php echo e(route('facility.index')); ?>">View All Facilities</a></li>
            <li><a href="<?php echo e(route('facility.create')); ?>">Add Facility</a></li>
          </ul>
          
        </li>
        <?php endif; // Entrust::hasRole ?>
        <li class="treeview">
          <a href="#"><i class="fa fa-motorcycle"></i> <span>Manage Routing</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <?php if(!Auth::guest()): ?>
                <?php if (\Entrust::hasRole(['hub_coordinator','administrator','national_hub_coordinator'])) : ?>  
                	<li><a href="<?php echo e(route('equipment.create')); ?>">Add New Bike</a></li>
                <?php endif; // Entrust::hasRole ?>
                	<li><a href="<?php echo e(route('equipment.index')); ?>">View All Bikes</a></li>
                <?php if (\Entrust::hasRole('hub_coordinator')) : ?> 
                	<li><a href="<?php echo e(route('routingschedule.show', ['id' => Auth::user()->hubid])); ?>">Routing Schedule</a></li>
                  <li><a class="" href="javascript:void(0)"
                        data-toggle="modal" data-target="#thedate">Add Daily Route</a></li>
                <?php endif; // Entrust::hasRole ?>
          <?php endif; ?>

          </ul>
        </li>
               
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Sample Transporters</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <?php if(!Auth::guest()): ?>
            <?php if(Auth::user()->can('create-sample-transporter')): ?>
            <li><a href="<?php echo e(url('staff/new/1')); ?>">Add New Sample Transporter</a></li>
            <?php endif; ?>
          	<li><a href="<?php echo e(url('staff/list/1')); ?>">View All Sample Transporters</a></li>
          
          <?php endif; ?>

          </ul>
        </li>
        
        <li class="treeview" style = "display:none">
          <a href="#"><i class="fa fa-arrows"></i> <span>Sample Tracking</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <?php if(!Auth::guest()): ?>
            <li><a href="<?php echo e(route('sampletracking.create')); ?>">Refer Sample</a></li>
          	<li><a href="<?php echo e(route('sampletracking.index')); ?>">All referred Samples</a></li>
          
          <?php endif; ?>

          </ul>
        </li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>