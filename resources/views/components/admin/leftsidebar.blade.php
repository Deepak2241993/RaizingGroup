@php
    $setting = App\Models\Websitesetting::where('status', 1)->first();
    // dd($setting);
@endphp <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/master-admin/dashboard') }}" class="brand-link">
        <img src="@if ($setting['web_logo'] != '' && $setting['web_logo'] != null) {{ url('/images/settings/' . $setting['web_logo']) }} @endif"
            alt="Raizing Logo" class="brand-image  elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Raizing 365</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div><span class="text-light"> | </span>
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
                <li class="nav-header">MASTER ADMIN</li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('master-dashboard') }}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- To Do Task -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-tasks"></i>
                        <p>
                            To Do Task
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    My Task
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

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

                <!-- Brand & Company -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-building"></i>
                        <p>
                            Brand & Company
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('company.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Company</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('company.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Company</p>
                            </a>
                        </li>

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
                            <a href="{{ route('employee.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee List & Task</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('employeetask.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Employee Task List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('managementtask.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Super Admin Task</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admintask.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Management Task</p>
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
                        <li class="nav-item"><a href="{{ route('EmpLeave') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Employee Leave</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('AdminLeave') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Admin Leave</p>
                            </a></li>
                    </ul>
                </li>

                <!-- Vendor Management -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Vendor Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item"><a href="{{ route('vendor.create') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Add Vendor</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('vendor.index') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>All Vendor</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('vendor-task.create') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Assign Task</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('vendor-task.index') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Vendor Task</p>
                            </a></li>

                    </ul>
                </li>

                <!-- Web Setting -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>
                            Web Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item"><a href="{{ route('settings.create') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Update Web Settings</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('settings.index') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Website Settings</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('login_details.index') }}" class="nav-link"><i
                                    class="far fa-circle nav-icon"></i>
                                <p>Login Details</p>
                            </a></li>

                    </ul>
                </li>

                {{-- Feture Scope --}}
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

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
