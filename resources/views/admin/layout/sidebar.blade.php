<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">ZENIX Motors</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/images/user.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
                @if(Session::get('page') == "dashboard")
                @php $active = "active" @endphp
                @else
                @php $active = "" @endphp
                @endif
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if(Session::get('page') == "updatePassword" || Session::get('page') == "updateDetails")
                @php $active = "active" @endphp
                @else
                @php $active = "" @endphp
                @endif
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Session::get('page') == "updatePassword")
                        @php $active = "active" @endphp
                        @else
                        @php $active = "" @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/update-password') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Admin Password</p>
                            </a>
                        </li>
                        @if(Session::get('page') == "updateDetails")
                        @php $active = "active" @endphp
                        @else
                        @php $active = "" @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/update-details') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Admin Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(Session::get('page') == "cms-pages")
                @php $active = "active" @endphp
                @else
                @php $active = "" @endphp
                @endif
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/cms-pages') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            CMS Pages
                        </p>
                    </a>
                </li>
                @if(Session::get('page') == "motorcycles" || Session::get('page') == "accessories")
                @php $active = "active" @endphp
                @else
                @php $active = "" @endphp
                @endif
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Session::get('page') == "motorcycles")
                        @php $active = "active" @endphp
                        @else
                        @php $active = "" @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/motorcycles') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Motorcycles</p>
                            </a>
                        </li>
                        @if(Session::get('page') == "accessories")
                        @php $active = "active" @endphp
                        @else
                        @php $active = "" @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ url('admin/accessories') }}" class="nav-link {{ $active }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Accessories</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(Session::get('page') == "reservations")
                        @php $active = "active" @endphp
                        @else
                        @php $active = "" @endphp
                        @endif
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/reservations') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Reservations
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="{{ url('admin/orders') }}" class="nav-link {{ $active }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/logout') }}" class="nav-link">Logout <span class="mx-5"></span><span class="mx-4"></span><i class="fas fa-sign-out-alt"></i></a>  
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>