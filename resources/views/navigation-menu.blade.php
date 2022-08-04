<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{Auth::user()->name}}
                <span style="font-size: 12px;">
                    <i class="right fas fa-angle-down"></i>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                <span class="dropdown-item dropdown-header text-center">Manage Account</span>
                <div class="dropdown-divider"></div>
                <a href="" class="nav-link">Profile
                    <span class="float-right text-muted text-sm">
                        <i class="far fa-user-circle"></i>
                    </span>
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                        <span class="float-right text-muted text-sm">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('Dashboard')}}" class="brand-link">
        <img src="{{asset('assets')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('Dashboard')}}" class="nav-link {{ request()->routeIs('Dashboard') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(Auth::User()->role == 1)
                <li class="nav-header">Kalog</li>
                <li class="nav-item {{ request()->routeIs('Awn') || request()->routeIs('Add Awn')  ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ request()->routeIs('Awn') || request()->routeIs('Add Awn') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Awn
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('Awn')}}" class="nav-link {{ request()->routeIs('Awn') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Awn</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Add Awn')}}" class="nav-link {{ request()->routeIs('Add Awn') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Awn</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->routeIs('Nambo') || request()->routeIs('Add Nambo')  ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link {{ request()->routeIs('Nambo') || request()->routeIs('Add Nambo') ? 'active' : ''}}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Nambo
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('Nambo')}}" class="nav-link {{ request()->routeIs('Nambo') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Nambo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Add Nambo')}}" class="nav-link {{ request()->routeIs('Add Nambo') ? 'active' : ''}}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Nambo</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>