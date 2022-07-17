<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="{{ url('/dashboard') }}">
                <div class="logo-img">

                </div>
                <span class="text"><strong>{{ strtoupper(Auth()->user()->name) }}</strong></span>
            </a>

        </div>

        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">

                    <div class="nav-item active">
                        <a href="{{ url('dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>
                    @if (auth()->user()->role_id == 1)
                    <div class="nav-item active">
                        <a href="{{ route('doctor.my_profile') }}"><i class="ik ik-user"></i><span>My Profile</span></a>
                    </div>
                    <div class="nav-item active">
                        <a href="{{ route('doctor.dpatients') }}"><i class="ik ik-users"></i><span>Patients</span></a>
                    </div>
                    <div class="nav-item active">
                        <a href="{{ route('doctor.disease_info') }}"><i class="ik ik-users"></i><span>Disease Info</span></a>
                    </div>

                    <div class="nav-item active">
                        <a href="{{ route('doctor.feedback') }}"><i class="ik ik-users"></i><span>Feedback</span></a>
                    </div>
                    @endif

                    @if (auth()->user()->role_id == 2)
                    <div class="nav-item active">
                        <a href="{{ route('doctor.patients') }}"><i class="ik ik-users"></i><span>Patients</span></a>
                    </div>
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Department</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('department.create') }}" class="menu-item">Create</a>
                            <a href="{{ route('department.index') }}" class="menu-item">View</a>

                        </div>
                    </div>

                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Doctor</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('doctor.create') }}" class="menu-item">Add Doctor</a>
                            <a href="{{ route('doctor.index') }}" class="menu-item">View</a>

                        </div>
                    </div>
                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Feedbacks</span> <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('doctor_feedbacks') }}" class="menu-item">Dotcors</a>
                            <a href="{{ route('patient_feedbacks') }}" class="menu-item">Patients</a>

                        </div>
                    </div>



                    @endif

                    <div class="nav-item active">
                        <a onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><i class="ik ik-power dropdown-icon"></i><span>Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>
