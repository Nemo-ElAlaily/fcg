<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <img class="w-50" src="{{ $site_settings->logo_path }}" alt="Company Logo">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user() -> avatar_path }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user() -> full_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.index')}}" class="nav-link {{ Route::currentRouteName() == 'admin.index' ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('dashboard.settings.site.show', 1) }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.settings.site.show' ? 'active' : '' }}">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>Site Settings</p>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a href="{{ route('dashboard.pages.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.pages.index' ? 'active' : '' }}">
                        <i class="fa fa-newspaper nav-icon"></i>
                        <p>Pages</p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="{{ route('dashboard.branches.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.branches.index' ? 'active' : '' }}">
                        <i class="fa fa-code-branch nav-icon"></i>
                        <p>Branches</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.categories.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.categories.index' ? 'active' : '' }}">
                        <i class="fa fa-hashtag nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.certificates.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.certificates.index' ? 'active' : '' }}">
                        <i class="fa fa-certificate nav-icon"></i>
                        <p>Certificates</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.clients.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.clients.index' ? 'active' : '' }}">
                        <i class="fa fa-mug-hot nav-icon"></i>
                        <p>Clients</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.partners.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.partners.index' ? 'active' : '' }}">
                        <i class="fa fa-handshake nav-icon"></i>
                        <p>Partners</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.offices.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.offices.index' ? 'active' : '' }}">
                        <i class="fa fa-briefcase nav-icon"></i>
                        <p>PM Offices</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.projects.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.projects.index' ? 'active' : '' }}">
                        <i class="fa fa-project-diagram nav-icon"></i>
                        <p>Projects</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.services.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.services.index' ? 'active' : '' }}">
                        <i class="fa fa-bell nav-icon"></i>
                        <p>Services</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.sliders.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.sliders.index' ? 'active' : '' }}">
                        <i class="fa fa-image nav-icon"></i>
                        <p>Sliders</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('dashboard.contact.index') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.contact.index' ? 'active' : '' }}">
                        <i class="fa fa-phone nav-icon"></i>
                        <p>Contact Forms</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
