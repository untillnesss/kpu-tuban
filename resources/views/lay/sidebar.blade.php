
<!-- Sidebar -->
<ul class="sidebar navbar-nav" style="transition: all .4s ease-out">
    <li class="nav-item @if(Route::currentRouteName() == 'dashboard') active @endif">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'operator') active @endif">
        <a class="nav-link" href="{{route('operator')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>Operator</span>
        </a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'calon') active @endif">
        <a class="nav-link" href="{{route('calon')}}">
            <i class="fas fa-fw fa-user-check"></i>
            <span>Calon</span>
        </a>
    </li>
    <li class="nav-item @if(Route::currentRouteName() == 'dashboard') active @endif">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-envelope-open-text"></i>
            <span>Hasil Suara</span>
        </a>
    </li>
    {{-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Login Screens:</h6>
            <a class="dropdown-item" href="login.html">Login</a>
            <a class="dropdown-item" href="register.html">Register</a>
            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="404.html">404 Page</a>
            <a class="dropdown-item" href="blank.html">Blank Page</a>
        </div>
    </li> --}}
</ul>
