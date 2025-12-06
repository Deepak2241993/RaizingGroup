

   @php
    $setting=App\Models\Websitesetting::where('status',1)->first();
    // dd($setting);
@endphp   <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ url('/master-admin/dashboard') }}" class="brand-link">
          <img src="@if($setting['web_logo']!='' && $setting['web_logo']!=null){{url('/images/settings/'.$setting['web_logo'])}}  @endif" alt="Raizing Logo"
              class="brand-image  elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Raizing 365</span>
      </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
       <div class="user-panel mt-3 pb-3 mb-3 d-flex">

              <div class="info">
                  <a href="#" class="d-block">{{ Auth::user()->name }}</a>
              </div>
               <div class="info">
                <a href="#" class="d-block">{{ ucfirst(str_replace('_', ' ', Auth::user()->type)) }}</a> 
              </div>
          </div>


        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('master-dashboard') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboards</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Task Details
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('vendor-task.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Assigned Task</p>
                            </a>
                        </li>


                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
