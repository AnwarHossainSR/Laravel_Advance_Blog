<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('homepage') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
        </button>
        </div>
    </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-danger navbar-badge">{{ Auth::user()->unreadNotifications->count() }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ Auth::user()->unreadNotifications->count() }} Notifications</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> new email
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i>New users
        </a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> new posts
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('superadmin.notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
    </li>
    <li class="nav-item">
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
          </div>
    </li>
    </ul>
</nav>
