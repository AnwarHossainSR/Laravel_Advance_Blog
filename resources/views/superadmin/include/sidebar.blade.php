<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('superadmin.dashboard') }}" class="brand-link">
    <img src="{{ asset('source/back') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Super Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ asset('source/back/profile') }}/{{ Auth::user()->profileImage }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="{{ route('manage.show',Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon text-primary class
            with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('superadmin.dashboard') }}" class="nav-link">
                <i class="nav-icon text-primary fas fa-th"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link ">

            <i class="nav-icon text-primary fab fa-affiliatetheme"></i>
                <p>
                    Category management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Manage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.unpublished') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Unpublished Category</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fab fa-usps text-primary"></i>
                <p>
                    Post management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('post.index') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Manage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('superadmin.post.singleuser') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Post By Me</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('superadmin.post.favorite') }}" class="nav-link ">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Favorite Post</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-users"></i>
                <p>
                    User management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('manage.index') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Active Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.deactive') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Deactive Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('role.manage') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Manage Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('request.user') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>User Request</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-comment"></i>
                <p>
                    Comments 
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('comment.index') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Manage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('comments.self') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Comments by me</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-envelope-open"></i>
                <p>
                    Emailing
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('email.index') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Manage</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-subscript"></i>
                <p>
                    Subscriber manage
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('subscriber.index') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Manage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('subscriber.email.show') }}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Send News</p>
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-phone-volume"></i>
            <p>
                Video Call
               {{--  <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        
        <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link">
            <i class="nav-icon text-primary fas fa-user-cog"></i>
            <p>
                Settings
               {{--  <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="nav-icon text-danger fas fa-sign-out-alt"></i>
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
