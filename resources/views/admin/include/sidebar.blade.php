<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <img src="{{ asset('source/back') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ asset('source/back/profile') }}/{{ Auth::user()->profileImage }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="{{ route('admin.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon text-primary class
            with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ (request()->is('dashboard/admin')) ? 'active': '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="{{ route('admin.category.all') }}" class="nav-link {{ (request()->is('admin/category*')) ? 'active': '' }}">

            <i class="nav-icon fas fa-shopping-basket"></i>
                <p>
                    Category management
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="{{ route('admin.tags.all') }}" class="nav-link {{ (request()->is('admin/tag*')) ? 'active': '' }}">

            <i class="nav-icon fas fa-tags"></i>
                <p>
                    Tag Management
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link ">

            <i class="nav-icon fas fa-clipboard"></i>
                <p>
                    Post Management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.posts.all') }}" class="nav-link {{ (request()->is('admin/posts*')) ? 'active': '' }}">
                    <i class="fas fa-tasks nav-icon "></i>
                    <p>Manage Post</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.pending') }}" class="nav-link {{ (request()->is('admin/post/pending*')) ? 'active': '' }}">
                    <i class="fab fa-twitch nav-icon "></i>
                    <p>Pending Post</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.own') }}" class="nav-link {{ (request()->is('admin/posts/own*')) ? 'active': '' }}">
                    <i class="fas fa-user-shield nav-icon "></i>
                    <p>Admin Post</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.posts.favourite') }}" class="nav-link {{ (request()->is('admin/posts/favourite*')) ? 'active': '' }}">
                    <i class="fas fa-user-shield nav-icon "></i>
                    <p>Favourite Post</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="{{ route('admin.profile') }}" class="nav-link {{ (request()->is('admin/profile*')) ? 'active': '' }}">

            <i class="nav-icon fas fa-user"></i>
                <p>
                    Profile
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
                Logout
               {{--  <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>








        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
