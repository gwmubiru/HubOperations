<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>UNHLS | Hub Operations Module</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
 @yield('css')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="{{ asset('css/skin-blue.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>UNHLS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>UNHLS</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
          <!-- User Account Menu -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             	{{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="{{ url('/logout') }}">
                      <i class="fa  fa-sign-out text-aqua"></i> 
                                            Logout</a>
                                        

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                    
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-yellow"></i> Profile
                    </a>
                  </li>
                  
                </ul>
              </li>
            </ul>
          </li>         
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
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
          <a href="#"><i class="fa fa-user"></i> <span>Manage Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a> 
          
          <ul class="treeview-menu">
          @role('Admin')
          	<li><a href="{{ route('roles.create') }}">Create Role</a></li>
           	<li><a href="{{ route('roles.index') }}">View All Roles</a></li>
           @endrole
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
          </ul>
          
        </li>
        @endrole
        <li class="treeview">
          <a href="#"><i class="fa fa-motorcycle"></i> <span>Manage Bikes</span>
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
                        data-toggle="modal" data-target="#weekend-update">Add Daily Route</a></li>
                    
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
            <li><a href="{{ url('staff/new/1') }}">Add New Sample Transporter</a></li>
          	<li><a href="{{ url('staff/list/1') }}">View All Sample Transporters</a></li>
          
          @endif

          </ul>
        </li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>
       <ul class="list-inline context-menu">
      	<li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
       <?php echo generateContextMenu(Request::url());?>
      </ul>
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->

  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#">UNHLS</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="weekend-update">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Date</h4>
      </div>
      <div class="modal-body">
      	<div class="box box-info no-border"> 
      	{{ Form::open(array('url' => 'dailyrouting/setweekendingdates', 'class' => 'form-horizontal', 'id' => 'week-ending')) }}
  {{ csrf_field() }}
  
  			<div class="form-group">
              <label for="dateofweek" class="col-sm-3 control-label">{{ Form::label('dateofweek', 'Date') }}</label>
              <div class="col-sm-9">
                <input name="dateofweek" id="dateofweek" class="form-control" type="text">
              </div>
            </div>
  			<div class="box-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </button>
            {{ Form::submit('Continue', array('class' => 'btn btn-info pull-right')) }} </div>
          <!-- /.box-footer --> 
          
          {{ Form::close() }} </div>
  		</div> 
      </div>
     </div>
    </div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
@yield('listpagejs')
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@yield('js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> 
<script src="{{ asset('js/dashboard2.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#dateofweek').datepicker({
		   format: 'mm/dd/yyyy',
           endDate: '+0d',
		   autoclose: true
		});
	});
</script>
</body>
</html>