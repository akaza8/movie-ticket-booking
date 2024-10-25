<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="{{ asset('adminlte/index3.html') }} {{??}} #"class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('adminlte/dist/img/image copy.png') }}" class="img-rounded rounded text-center object-fit-contains"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="/admin/movies" class="d-block">Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('movies.index') }}" class="nav-link @yield('status1')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Movies
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>

                </li>


                <li class="nav-item">
                    <a href="{{ route('movies.create') }}" class="nav-link @yield('status2')">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Create
                            {{-- <i class="fas fa-angle-left right"></i> --}}
                        </p>
                    </a>

                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
