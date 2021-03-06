<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
{{--        <a href="{{ url('/admin') }}" class="brand-link">--}}
{{--            <img src="{{ asset('template/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">--}}
{{--            <span class="brand-text font-weight-light">AdminLTE 3</span>--}}
{{--        </a>--}}

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('template/admin/dist/img/my_avatar.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ url('/admin') }}" class="d-block">Nhat Dev</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Menu
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.menu.add') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add menu</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.menu.list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of menus</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-store-alt"></i>
                            <p> Products
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.product.add') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add product</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/products/list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List products</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-images"></i>
                            <p> Slider
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/admin/sliders/add') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Slider</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/sliders/list') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of Sliders</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <form class="logout-form" action="{{ route('admin.logout') }}" method="post">
                            @csrf
                            <a href="javascript:void(0)" class="nav-link" onclick="event.preventDefault(); document.querySelector('form.logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p><span class="badge badge-danger">Logout</span></p>
                            </a>
                        </form>

                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
