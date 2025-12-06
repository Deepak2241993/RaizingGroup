
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  < <title>Dashboard | 365 Raizing Group</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/')}}/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.0/css/font-awesome.css" integrity="sha512-CB+XYxRC7cXZqO/8cP3V+ve2+6g6ynOnvJD6p4E4y3+wwkScH9qEOla+BTHzcwB4xKgvWn816Iv0io5l3rAOBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   @stack('csslink')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
 <x-admin.topbar/>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
{{-- left side bar --}}
        @if( Auth::user()->type =='master_admin')
        <x-admin.leftsidebar/>
        @endif
        @if( Auth::user()->type =='HR')
        <x-admin.hr_sidebar/>
        @endif

        @if( Auth::user()->type =='Admin')
        <x-admin.admin_sidebar/>
        @endif

        @if( Auth::user()->type =='Employee')
        <x-admin.employee_sidebar/>
        @endif
        @if( Auth::user()->type =='Vendor')
        <x-admin.vendor_sidebar/>
        @endif

  <!-- Content Wrapper. Contains page content -->
  @yield('body')

 <x-admin.footer/>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<x-admin.footerscript/>
 @stack('footer-section-code')
</body>
</html>
