<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Hub Operations System</title>

<!-- Bootstrap core CSS -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Custom fonts for this template -->
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

<!-- Plugin CSS -->
<link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav"><a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name', 'Laravel') }} </a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Dashboard"> <a class="nav-link" href="#"> <i class="fa fa-fw fa-dashboard"></i> <span class="nav-link-text"> Dashboard</span> </a> </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components"> <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion"> <i class="fa fa-fw fa-wrench"></i> <span class="nav-link-text"> Manage Hubs</span> </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
          @if (!Auth::guest())
          <li><a href="{{ route('posts.create') }}">Add New Hub</a></li>
          <li><a href="{{ route('posts.create') }}">View All Hubs</a></li>
          <li><a href="{{ route('equipment.create') }}">Add new Bike</a></li>
          @endif
        </ul>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages"> <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion"> <i class="fa fa-fw fa-file"></i> <span class="nav-link-text">Manage IPs</span> </a>
        <ul class="sidenav-second-level collapse" id="collapseExamplePages">
          @if (!Auth::guest())
          <li><a href="{{ route('posts.create') }}">Add New IP</a></li>
          <li><a href="{{ route('posts.create') }}">View All IPs</a></li>
          @endif
        </ul>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="fa fa-fw fa-area-chart"></i>
              <span class="nav-link-text">
                Manage Users</span>
            </a>
          </li>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item"> <a class="nav-link text-center" id="sidenavToggler"> <i class="fa fa-fw fa-angle-left"></i> </a> </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      @if (Auth::guest())
      <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
      @else
      <li class="nav-item"> <a class="nav-link" href="{{ route('logout') }}"><i class="fa fa-fw fa-sign-out"></i> Logout</a> </li>
      @endif
    </ul>
  </div>
</nav>
<div class="content-wrapper">
  <div class="container-fluid"> 
    
    <!-- Breadcrumbs -->
    <!-- All this section  to be taken the view itself -->
    @yield('content')
  </div>
  <!-- /.container-fluid --> 
  
</div>
<!-- /.content-wrapper -->

<footer class="sticky-footer">
  <div class="container">
    <div class="text-center"> <small>Copyright &copy; Hub Operations System</small> </div>
  </div>
</footer>

<!-- Scroll to Top Button --> 
<a class="scroll-to-top rounded" href="#page-top"> <i class="fa fa-angle-up"></i> </a> 

<!-- Logout Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body"> Select "Logout" below if you are ready to end your current session. </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a> </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript --> 
<script src="{{ asset('js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/popper.min.js') }}"></script> 
<script src="{{ asset('js/bootstrap.min.js')}}"></script> 

<!-- Plugin JavaScript --> 
<script src="{{ asset('js/jquery.easing.min.js')}}"></script> 
<script src="{{ asset('js/Chart.min.js') }}"></script> 
<script src="{{ asset('js/jquery.dataTables.js') }}"></script> 
<script src="{{ asset('js/dataTables.bootstrap4.js')}}"></script> 

<!-- Custom scripts for this template --> 
<script src="{{ asset('js/sb-admin.min.js')}}"></script>
</body>
</html>
