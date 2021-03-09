<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('author.dashboard') }}" class="brand-link">
    <img src="{{ asset('source/back') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">Author Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{ asset('/storage/author_img') }}/{{ Auth::user()->profileImage }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="{{route('AuthorProfileController.view_profile')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon text-primary class
            with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('author.dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li>
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link ">

                <i class="fas fa-cogs fa-spin"></i>
                <p>
                    Post management
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('AuthorPostController.add_post') }}" class="nav-link {{-- active --}}">
                        <i class="fas fa-pen-nib"></i>
                    <p> Add new post</p>
                    </a>
                </li>
            </ul>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('AuthorPostController.view_all_unpublished_post')}}" class="nav-link {{-- active --}}">
                        <i class="fas fa-spinner fa-spin"></i>
                    <p> Pending Posts</p>
                    </a>
                </li>
            </ul>


            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('AuthorPostController.all_post_show')}}" class="nav-link {{-- active --}}">
                        <i class="fas fa-file-alt"></i>
                    <p> Show all post</p>
                   
                    </a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item has-treeview {{-- menu-open --}}">
            <a href="#" class="nav-link">
                <i class="fas fa-comment-dots"></i>
                <p>
                    Comment Management
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
                <i class="fas fa-envelope"></i>
            <p>
                Support
               {{--  <span class="right badge badge-danger">New</span> --}}
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('AuthorProfileController.view_profile')}}" class="nav-link">
                <i class="fas fa-user-circle"></i>
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
