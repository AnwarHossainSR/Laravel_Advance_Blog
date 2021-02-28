<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{-- {{ route('admin.dashboard') }} --}}" class="brand-link">
    <img src="{{ asset('source/back') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Author Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ asset('source/back/default.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon text-primary class
            with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('author.dashboard') }}" class="nav-link">
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
                    Post management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{-- {{ route('category.manage') }} --}}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Add new post</p>
                    </a>
                </li>
            </ul>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{-- {{ route('category.manage') }} --}}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Track post Status</p>
                    </a>
                </li>
            </ul>


            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{-- {{ route('category.manage') }} --}}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Show all post</p>
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
                    <a href="{{-- {{ route('post.index') }} --}}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Manage</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-address-book"></i>
                <p>
                    Contact
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{-- {{ route('post.index') }} --}}" class="nav-link {{-- active --}}">
                    <i class="far fa-circle nav-icon text-primary"></i>
                    <p>Manage</p>
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
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-comments"></i>
            <p>
               Chat Box
               {{--  <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-envelope"></i>
            <p>
                Emailing
               {{--  <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon text-primary fas fa-user-circle"></i>
            <p>
                Accounts
               {{--  <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
