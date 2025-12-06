
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


                  <!-- Dashboard -->
                  <li class="nav-item">
                      <a href="{{ route('employee-dashboard') }}" class="nav-link">
                          <i class="nav-icon bx bx-home-circle"></i>
                          <p>Dashboard</p>
                      </a>
                  </li>

                  <!-- Task Details -->
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-tasks"></i>
                          <p>
                              Task Details
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>

                      <ul class="nav nav-treeview">

                          <!-- Employee Task (Parent) -->
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>
                                      Employee Task
                                      <i class="right fas fa-angle-left"></i>
                                  </p>
                              </a>

                              <!-- Employee Task Submenu -->
                              <ul class="nav nav-treeview">

                                  <li class="nav-item">
                                      <a href="{{ route('employeetaskview') }}" class="nav-link">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>My Assigned Task</p>
                                      </a>
                                  </li>

                                  <li class="nav-item">
                                      <a href="{{ route('managementtask.index') }}" class="nav-link">
                                          <i class="far fa-dot-circle nav-icon"></i>
                                          <p>Task For Management</p>
                                      </a>
                                  </li>

                              </ul>
                          </li>

                      </ul>
                  </li>

                  <!-- Customer Query -->
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="fa fa-question-circle fa-2x" aria-hidden="true"></i>
                          <p>
                              Customer Query
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>

                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{ route('customer-query.create') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Add Query</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('customer-query.index') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>All Query</p>
                              </a>
                          </li>

                      </ul>
                  </li>

                  <!-- Leave Information -->
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-info-circle"></i>
                          <p>
                              Leave Information
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>

                      <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="{{ route('leave.create') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Apply Leave</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('EmpLeaveStatus') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>View Status</p>
                              </a>
                          </li>

                          <li class="nav-item">
                              <a href="{{ route('holiday.index') }}" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Holiday List</p>
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
