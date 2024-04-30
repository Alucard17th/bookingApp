<!-- <div class="my-2">
    <button class="btn bk-bg-orange toggle-sidebar"><i class="fas fa-arrow-left"></i></button>
</div> -->
<nav class="sidebar bg-white mt-3" id="secondary-navbar">
    <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav flex-column">
            <li class="nav-item mb-1 {{ request()->is('home*') ? 'active' : '' }}">
                <a class="nav-link p-2" href="{{ route('dashboard') }}">
                    <i class="me-1 fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li
                class="nav-item mb-1 dropdown {{ request()->is('appointments-calendar') || request()->is('events-calendar') ? 'active' : '' }}">
                <a class="nav-link p-2 dropdown-toggle" href="#" id="calendarsDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="me-1 fas fa-calendar-alt"></i>
                    Calendars
                </a>
                <ul class="dropdown-menu" aria-labelledby="calendarsDropdown">
                    <li><a class="dropdown-item {{ request()->is('events-calendar') ? 'active' : '' }}"
                            href="{{ route('user.events.calendar') }}">Events</a></li>
                    <li><a class="dropdown-item {{ request()->is('appointments-calendar') ? 'active' : '' }}"
                            href="{{ route('user.appointments.calendar') }}">Appointments</a></li>
                </ul>
            </li>
            <li
                class="nav-item mb-1 dropdown {{ request()->is('services') || request()->is('appointments') ? 'active' : '' }}">
                <a class="nav-link p-2 dropdown-toggle" href="#" id="servicesDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="me-1 fas fa-person-arrow-up-from-line"></i>
                    Services
                </a>
                <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                    <li><a class="dropdown-item {{ request()->is('services') ? 'active' : '' }}"
                            href="{{ route('services.index') }}">My Services</a></li>
                    <li><a class="dropdown-item {{ request()->is('appointments') ? 'active' : '' }}"
                            href="{{ route('appointments.index') }}">Appointments</a></li>
                </ul>
            </li>
            <li
                class="nav-item mb-1 dropdown {{ request()->is('events') || request()->is('bookings') ? 'active' : '' }}">
                <a class="nav-link p-2 dropdown-toggle" href="#" id="eventsDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="me-1 fas fa-people-line"></i>
                    Events
                </a>
                <ul class="dropdown-menu" aria-labelledby="eventsDropdown">
                    <li><a class="dropdown-item {{ request()->is('events') ? 'active' : '' }}"
                            href="{{ route('events.index') }}">My Events</a></li>
                    <li><a class="dropdown-item {{ request()->is('bookings') ? 'active' : '' }}"
                            href="{{ route('bookings.index') }}">Bookings</a></li>
                </ul>
            </li>
            <li class="nav-item mb-1 {{ request()->is('profile*') ? 'active' : '' }}">
                <a class="nav-link p-2 " href="{{ route('profile.index') }}"  role="button">
                    <i class="me-1 fas fa-cog"></i>
                    Settings
                </a>
            </li>
        </ul>

    </div>
</nav>