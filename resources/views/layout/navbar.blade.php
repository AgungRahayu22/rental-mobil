<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-3 py-2">
    <div class="container-fluid">
        <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-2" src="{{ asset('assets/img/pp.jpg') }}" alt="User Image" style="width: 45px; height: 45px;">
                    <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item">My Profile</a>
                    <a href="{{ route('login.keluar') }}" class="dropdown-item">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</nav>
