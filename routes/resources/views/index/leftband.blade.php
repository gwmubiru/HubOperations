<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      

    <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <!--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->
       @role(['Coordinator','Admin']) 
       	<li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Access Control</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="{{ route('roles.create') }}">Create Role</a></li>
           	<li><a href="{{ route('roles.index') }}">View All Roles</a></li>
            <li><a href="{{ route('permissions.create') }}">Create Permission</a></li>
            <li><a href="{{ route('permissions.index') }}">View All Permissions</a></li>
            <li><a href="{{ route('users.create') }}">Create User</a></li>
           	<li><a href="{{ route('users.index') }}">View All Users</a></li>
          </ul>
          
        </li>
       @endrole
       @role(['Coordinator','Admin','Regional_hub_coordinator']) 
       <li class="treeview">
          <a href="#"><i class="fa fa-institution"></i> <span>Manage IPs</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="{{ route('organization.create') }}">Add New IP</a></li>
           	<li><a href="{{ route('organization.index') }}">View All IPs</a></li>
          </ul>
          
        </li>
       <li class="treeview">
          <a href="#"><i class="fa fa-hospital-o"></i> <span>Manage Hubs</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          	<li><a href="{{ route('hub.create') }}">Add New Hub</a></li>
           	<li><a href="{{ route('hub.index') }}">View All Hubs</a></li>
            <li><a href="{{ route('hub.assignfacility') }}">Assign facilities to Hub</a></li>
          </ul>
          
        </li>
        <li class="treeview">
          <a href="#"><i class="fa  fa-plus"></i> <span>Manage Facilities</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
           	<li><a href="{{ route('facility.index') }}">View All Facilities</a></li>
            <li><a href="{{ route('facility.create') }}">Add Facility</a></li>
          </ul>
          
        </li>
        @endrole
        <li class="treeview">
          <a href="#"><i class="fa fa-motorcycle"></i> <span>Manage Routing</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (!Auth::guest())
                @role(['Admin','Regional_hub_coordinator','Coordinator']) 
                	<li><a href="{{ route('equipment.create') }}">Add New Bike</a></li>
                @endrole
                	<li><a href="{{ route('equipment.index') }}">View All Bikes</a></li>
                @role('In_charge') 
                	<li><a href="{{ route('routingschedule.show', ['id' => Auth::user()->hubid]) }}">Routing Schedule</a></li>
                  <li><a class="" href="javascript:void(0)"
                        data-toggle="modal" data-target="#thedate">Add Daily Route</a></li>
                @endrole
          @endif

          </ul>
        </li>
               
        <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Sample Transporters</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (!Auth::guest())
            @if(Auth::user()->can('create-sample-transporter'))
            <li><a href="{{ url('staff/new/1') }}">Add New Sample Transporter</a></li>
            @endif
          	<li><a href="{{ url('staff/list/1') }}">View All Sample Transporters</a></li>
          
          @endif

          </ul>
        </li>
        
        <li class="treeview" style = "display:none">
          <a href="#"><i class="fa fa-arrows"></i> <span>Sample Tracking</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @if (!Auth::guest())
            <li><a href="{{ route('sampletracking.create') }}">Refer Sample</a></li>
          	<li><a href="{{ route('sampletracking.index') }}">All referred Samples</a></li>
          
          @endif

          </ul>
        </li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>