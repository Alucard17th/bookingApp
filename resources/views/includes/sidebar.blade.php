<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="secondary-navbar">
    <div class="container">
        <div class="navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item me-1 {{ request()->is('home*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item dropdown {{ request()->is('services*') || request()->is('appointments*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-calendar-alt"></i>
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item {{ request()->is('services*') ? 'active' : '' }}" href="{{ route('services.index') }}">My Services</a></li>
                        <li><a class="dropdown-item {{ request()->is('appointments*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">Appointments</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown {{ request()->is('events*') || request()->is('bookings*') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-calendar"></i>
                        Events
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="eventsDropdown">
                        <li><a class="dropdown-item {{ request()->is('events*') ? 'active' : '' }}" href="{{ route('events.index') }}">My Events</a></li>
                        <li><a class="dropdown-item {{ request()->is('bookings*') ? 'active' : '' }}" href="{{ route('bookings.index') }}">Bookings</a></li>
                    </ul>
                </li>
                <li class="nav-item me-1 {{ request()->is('profile*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('profile.index') }}">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>