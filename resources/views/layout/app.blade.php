<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <title>Truckify | Administrator</title>
  <!-- Favicon -->
  <link rel="icon" href="{{asset('admin/img/book.png')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('admin/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

  <!-- Custom css -->
  <link rel="stylesheet" href="{{asset('admin/css/custom.css')}}">

  <!-- jQuery 3 -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- SlimScroll -->
  <script src="{{asset('')}}admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="{{asset('admin/bower_components/fastclick/lib/fastclick.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('admin/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('admin/js/demo.js')}}"></script>

  <script src="{{asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree();
      $('#datepicker').datepicker({
        format: 'yyyy-mm-dd'
      });
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
      });
    })
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-purple-light sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="{{url('dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>FY</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Truckify</b> Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <!-- <li class="user user-menu">
            <a href="#" class="dropdown-toggle">
              <span class="hidden-xs"><i class="fa fa-power-off"></i> Logout</span>
            </a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="min-height: 60px">
      <div class="info">
        <p>{{Session::get('nama')}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ (\Request::route()->getName() == 'dashboard') ? 'active' : ''}}">
        <a href="{{url('dashboard')}}">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="{{ (\Request::route()->getName() == 'kendaraan') ? 'active' : ''}}">
        <a href="{{url('kendaraan')}}">
          <i class="fa fa-truck"></i> <span>Data Kendaraan</span>
        </a>
      </li>
      <li class="{{ (\Request::route()->getName() == 'storing') ? 'active' : ''}}">
        <a href="{{url('storing')}}">
          <i class="fa fa-wrench"></i> <span>Data Storing</span>
        </a>
      </li>
      <li class="treeview  {{ (\Request::route()->getName()=='kamadjaya' || \Request::route()->getName()=='datascript' || \Request::route()->getName()=='sogood' ) ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-briefcase"></i> <span>Project</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (\Request::route()->getName() == 'kamadjaya') ? 'active' : ''}}"><a href="{{url('kamadjaya')}}"><i class="fa fa-circle-o"></i> Kamadjaya</a></li>
          <li class="{{ (\Request::route()->getName() == 'datascript') ? 'active' : ''}}"><a href="{{url('datascript')}}"><i class="fa fa-circle-o"></i> Data Script</a></li>
          <li class="{{ (\Request::route()->getName() == 'sogood') ? 'active' : ''}}"><a href="{{url('sogood')}}"><i class="fa fa-circle-o"></i> So Good</a></li>
        </ul>
      </li>
      <li class="{{ (\Request::route()->getName() == 'pengeluaran') ? 'active' : ''}}">
        <a href="{{url('pengeluaran')}}">
          <i class="fa fa-money"></i> <span>Pengeluaran</span>
        </a>
      </li>
      <li class="{{ (\Request::route()->getName() == 'invoice') ? 'active' : ''}}">
        <a href="{{url('invoice')}}">
          <i class="fa fa-file-o"></i> <span>Invoice</span>
        </a>
      </li>
      @if(Session::get('role') == 'admin')
      <li class="treeview {{ (\Request::route()->getName() == 'users' || \Request::route()->getName() == 'jenis') ? 'active' : ''}}">
        <a href="#">
          <i class="fa fa-gear"></i> <span>Pengaturan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{ (\Request::route()->getName() == 'users') ? 'active' : ''}}"><a href="{{url('users')}}"><i class="fa fa-circle-o"></i> Users dan Mekanik</a></li>
          <li class="{{ (\Request::route()->getName() == 'jenis') ? 'active' : ''}}"><a href="{{url('jenis')}}"><i class="fa fa-circle-o"></i> Jenis kendaraan dan Harga</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Others</a></li>
        </ul>
      </li>
      @endif
      <li>
        <a onclick="return confirm('Anda ingin logout?')" href="{{url('logout')}}">
          <i class="fa fa-power-off"></i> <span>Logout</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Truckify</b> version 1.0
    </div>
    <strong>Copyright &copy; {{date("Y")}}</strong>
  </footer>
</div>
<!-- ./wrapper -->
</body>
</html>
