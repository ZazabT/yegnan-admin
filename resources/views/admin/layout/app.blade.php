<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Dashboard for Yegnan">
    <meta name="author" content="Yegnan Admin">
    <title>Admin Dashboard - Yegnan</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="icon" href="1728999055_yegnaLogo-removebg.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="{{ url('/') }}">
            Yegnan Admin
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (Auth::check())
                    @php
                        $adminUser = Auth::guard('admin')->user();
                        $firstName = explode(' ', $adminUser->name)[0];
                    @endphp
                          @if($adminUser->profile_picture)
                               <img src="{{ asset('storage/'.Auth::guard('admin')->user()->profile_picture) }}" alt="Profile Picture" width="30" height="30" class="rounded-circle">
                           @else
                               <img src="https://ui-avatars.com/api/?name={{ $firstName }}" alt="Profile Picture" width="30" height="30" class="rounded-circle">
                           @endif
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Profile</a></li>
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Management</div>
                        <a class="nav-link" href="{{route('users')}}">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Users
                        </a>
                        <a class="nav-link" href="{{ url('/bookings') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                            Bookings
                        </a>
                        <a class="nav-link" href="{{ url('/listings') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Property Listings
                        </a>
                        <a class="nav-link" href="{{ url('/reviews') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                            Categories
                        </a>
                        <a class="nav-link" href="{{ url('/reviews') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-star"></i></div>
                            Reviews
                        </a>
                        <a class="nav-link" href="{{ url('/reports') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Reports
                        </a>
                        <div class="sb-sidenav-menu-heading">Settings</div>
                        <a class="nav-link" href="{{ url('/settings') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                            Website Settings
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin
                </div>
            </nav>
        </div>

        <!-- Main content area -->
        <div id="layoutSidenav_content">
            @yield('content') <!-- This is where the content will be injected -->
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    
</body>
</html>
