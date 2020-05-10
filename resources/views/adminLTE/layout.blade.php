@php
$user = Auth::user();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>@stack('title')</title>
  <script src="{{ asset('js/app.js') }}"></script>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/theme/adminlte/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600" rel="stylesheet">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  @stack('styles')

  <style>
    html,
    body {
      font-family: 'Nunito', sans-serif;
      font-weight: 600;
    }
    [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:focus, [class*=sidebar-dark-] .nav-treeview>.nav-item>.nav-link.active:hover {
        background-color: #6c757d;
        color: #f8f9fa;
    }

    .bootstrap-select .btn {
      background: #fff!important;
      border: 1px solid #bfcbd9!important;
      padding: 4px 10px !important;
      height: 37px !important;
      text-transform: inherit;
      padding-left: 10px;
    }

    .dropdown-menu-right {
        left: -150px !important;
    }
    .dropdown-item-title {
      font-size: 1rem;
      margin: 0;
      text-overflow: ellipsis;
      overflow: hidden;
      /* white-space: nowrap; */
      /* display: inline-block; */
      width: 180px;
    }
  </style>
  <script>
    const BASE = '{{ url('') }}';
    const LANG = '{{config('app.fallback_locale')}}';
  </script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
{{-- <body class="hold-transition sidebar-mini"> --}}
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper" id="app">
  <!-- Navbar -->
  {{-- <nav class="main-header navbar navbar-expand navbar-white navbar-light"> --}}
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('profile')}}" class="nav-link">Profile</a>
      </li> --}}
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3 d-none d-md-block">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{avatar_image($user)}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/theme/adminlte/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/theme/adminlte/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" id="open-notification">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{count_notify(Auth::user())}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="dropdown-notification">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          {{-- <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a> --}}
          <div class="dropdown-divider"></div>
          <a href="{{route('notification')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/theme/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}} <sup style="font-size: 12px">V{{conf('version')}}</sup></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image" style="margin-top: 8pt">
          @php
            $url = isset($user->get_avatar->url) ? $user->get_avatar->url:url('/data/images/default.png');
          @endphp
          <img src="{{$url}}" class="img-circle elevation-2 user-image" alt="User Image">
        </div>
        <div class="info">
          @php
              $user = Auth::user();
          @endphp
          <a href="{{route('profile')}}" class="d-block">{{ $user->name }}</a>
          <a href="{{route('profile')}}" class="d-block"><small>{{ $user->email }}</small></a>
        </div>
      </div>
      @include('adminLTE.menu')
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@stack('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">@stack('page-name')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer text-sm">
    <strong>Copyright &copy; {{Date('Y')}} Dea Anggi Rahmawati.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> {{conf('version')}}
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/theme/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE -->
<script src="/theme/adminlte/dist/js/adminlte.js"></script>

<!-- Swal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('js/custom_plugin.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('service-worker.js') }}"></script>
<script src="/theme/adminlte/dist/js/demo.js"></script>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
  $("#open-notification").click(function() {
    let open = $(this).parent().hasClass("show");
    if(!open) {
      axios.post(`{{route("notification")}}`).then(res => {
        
        $('.notification-item,.notification-divider').remove()
        
        let html = '';
        
        res.data.notifications.forEach(i => {
          
          let val = i.data;
          html   += add_notification(val.title, i.created_at, val.image);

        })

        $("#dropdown-notification").find(".dropdown-divider:eq(0)").after(html);
      })
    }
  })

  function add_notification(title, time='', icon='', action='') {
    let html = `
    <a href="#" class="dropdown-item notification-item" >
        <!-- Message Start -->
        <div class="media">
          <img src="${icon != '' ? icon:'/data/images/default.png' }" alt="User Avatar" class="img-size-50 img-circle mr-3">
          <div class="media-body">
            <h3 class="dropdown-item-title">
              ${title}
            </h3>
            <p class="text-sm">The subject goes here</p>
            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${timeSince(new Date(time))}</p>
          </div>
        </div>
    </a>
    <div class="dropdown-divider notification-divider"></div>
  
    `;
    return html;
  }
})
</script>

@stack('scripts')

</body>
</html>
