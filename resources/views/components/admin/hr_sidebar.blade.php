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
                    <a href="{{ route('master-dashboard') }}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Task Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-tasks"></i>
                        <p>
                            Task Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <!-- My Task Parent -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    My Task
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <!-- My Task Submenu -->
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('tasks.create') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Assign Task</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('tasks.index') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>My Assigned Task</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </li>

                <!-- HR Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            HR Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Employee Data Management</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Job Opening Management</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Applicants Management</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Employee Training Data</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Benefit Management</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Documents Management</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Project Tracking</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Access from Devices</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Company Info Management</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Setup Password Protection</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>HR Manager Reminder</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Employee Attendance Methods</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ url('/admin/contents') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Common Offer Letter</p>
                            </a></li>

                    </ul>
                </li>

                <!-- Emp & Task Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                            Emp & Task Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('employee.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Employee</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('employee.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('managementtask.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Task For Management</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('employeetask.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Employee Task</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admintask.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Admin Task</p>
                            </a>
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

                <!-- Holiday Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Holiday Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('holiday.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Holiday</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('holiday.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Holiday</p>
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
                            <a href="{{ route('EmpLeave') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Leave</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('AdminLeave') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Admin Leave</p>
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






















<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <hr>
                <li class="menu-title" key="t-menu">HR Panel</li>
                <hr>

                <li>
                    <a href="{{ route('master-dashboard') }}" class="waves-effect">
                        <i class="fa fa-home  font-size-24"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-tasks font-size-18"></i>
                        <span key="t-layouts">Task Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-vertical">My Task</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('tasks.create') }}" key="t-compact-sidebar">Assign Task</a>
                                </li>
                                <li><a href="{{ route('tasks.index') }}" key="t-light-sidebar">My Assigned Task</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-users font-size-18"></i>
                        <span key="t-layouts">HR Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Employee Data Management</a>
                        </li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Job Opening Management</a>
                        </li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Applicants Management</a></li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Employee Training Data</a>
                        </li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Benefit Management</a></li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Documents Management</a></li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Project Tracking</a></li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Access from Devices</a></li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Company info Management</a>
                        </li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Setup Password Protection</a>
                        </li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">HR Manager Reminder</a></li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Employee Attendance
                                Methods</a></li>
                        <li><a href="{{ url('/admin/contents') }}" key="t-tui-content">Common offer letter</a></li>


                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-server font-size-18"></i>
                        <span key="t-layouts">Emp & Task Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                        <li><a href="{{ route('employee.create') }}" key="t-light-sidebar">Add Employee </a></li>
                        <li><a href="{{ route('employee.index') }}" key="t-light-sidebar">Employee List </a></li>
                        <li><a href="{{ route('managementtask.index') }}" key="t-light-sidebar">Task For
                                Management</a></li>
                        <li><a href="{{ route('employeetask.index') }}" key="t-light-sidebar">All Employee Task</a>
                        </li>
                        <li><a href="{{ route('admintask.index') }}" key="t-light-sidebar">All Admin Task</a></li>
                </li>
            </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-quora font-size-18"></i>
                    <span key="t-layouts">Customer Query</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                    <li><a href="{{ route('customer-query.create') }}" key="t-compact-sidebar">Add Query</a></li>
                    <li><a href="{{ route('customer-query.index') }}" key="t-compact-sidebar">All Query</a></li>
            </li>
            </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-list font-size-18"></i>
                    <span key="t-layouts">Holiday Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                    <li><a href="{{ route('holiday.create') }}" key="t-compact-sidebar">Add Holiday</a></li>
                    <li><a href="{{ route('holiday.index') }}" key="t-compact-sidebar">All Holiday</a></li>
            </li>
            </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-info-circle font-size-18"></i>
                    <span key="t-layouts">Leave Infomation</span>
                </a>
                <ul class="sub-menu" aria-expanded="true">
                    <li>
                    <li><a href="{{ route('EmpLeave') }}" key="t-compact-sidebar">Employee Leave</a></li>
                    <li><a href="{{ route('AdminLeave') }}" key="t-compact-sidebar">Admin Leave</a></li>
            </li>
            </ul>
            </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
