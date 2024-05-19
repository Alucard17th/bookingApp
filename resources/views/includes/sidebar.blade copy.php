<nav class="sidebar bg-white mt-3" id="secondary-navbar">
    <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav flex-column">
            <li class="nav-item mb-1 {{ request()->is('home*') ? 'active' : '' }}">
                <a class="nav-link p-2" href="{{ route('dashboard') }}">
                    <i class="me-1 fas fa-home"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link p-2 toggle-submenu {{ request()->is('appointments-calendar') || request()->is('events-calendar') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#calendarsSubMenu" aria-expanded="false">
                    <i class="me-1 fas fa-calendar-alt"></i>
                    Calendars
                    <span class="arrow"></span>
                </a>
                <ul class="ps-4 list-unstyled collapse {{ request()->is('appointments-calendar') || request()->is('events-calendar') ? 'show' : '' }}"
                    id="calendarsSubMenu">
                    <li><a class="p-2 dropdown-item {{ request()->is('events-calendar') ? 'active' : '' }}"
                            href="{{ route('user.events.calendar') }}">Events</a></li>
                    <li><a class="p-2 dropdown-item {{ request()->is('appointments-calendar') ? 'active' : '' }}"
                            href="{{ route('user.appointments.calendar') }}">Appointments</a></li>
                </ul>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link p-2 toggle-submenu {{ request()->is('services') || request()->is('appointments') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#servicesSubMenu" aria-expanded="false">
                    <i class="me-1 fas fa-person-arrow-up-from-line"></i>
                    Services
                    <span class="arrow"></span>
                </a>
                <ul class="ps-4 list-unstyled collapse {{ request()->is('services') || request()->is('appointments') ? 'show' : '' }}"
                    id="servicesSubMenu">
                    <li><a class="p-2 dropdown-item {{ request()->is('services') ? 'active' : '' }}"
                            href="{{ route('services.index') }}">My Services</a></li>
                    <li><a class="p-2 dropdown-item {{ request()->is('appointments') ? 'active' : '' }}"
                            href="{{ route('appointments.index') }}">Appointments</a></li>
                </ul>
            </li>
            {{-- <li class="nav-item mb-1">
                <a class="nav-link p-2 mb-1 toggle-submenu {{ request()->is('events') || request()->is('bookings') ? 'active' : '' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#eventsSubMenu" aria-expanded="false">
                    <i class="me-1 fas fa-people-line"></i>
                    Events
                    <span class="arrow"></span>
                </a>
                <ul class="ps-4 list-unstyled collapse {{ request()->is('events') || request()->is('bookings') ? 'show' : '' }}"
                    id="eventsSubMenu">
                    <li><a class="p-2 dropdown-item {{ request()->is('events') ? 'active' : '' }}"
                            href="{{ route('events.index') }}">My Events</a></li>
                    <li><a class="p-2 dropdown-item {{ request()->is('bookings') ? 'active' : '' }}"
                            href="{{ route('bookings.index') }}">Bookings</a></li>
                </ul>
            </li> --}}
            <li class="nav-item mb-1 {{ request()->is('profile*') ? 'active' : '' }}">
                <a class="nav-link p-2 " href="{{ route('profile.index') }}"  role="button">
                    <i class="me-1 fas fa-cog"></i>
                    Settings
                </a>
            </li>
        </ul>
    </div>
</nav>


<style>
.arrow {
    display: inline-block;
    width: 0;
    height: 0;
    margin-left: auto;
    border-style: solid;
    border-width: 5px 5px 0 5px;
    border-color: #000 transparent transparent transparent;
    transition: transform 0.3s;
}

.nav-item .collapse.show + .toggle-submenu .arrow {
    transform: rotate(-180deg);
}
</style>

<script>
    document.querySelectorAll('.toggle-submenu').forEach((toggle) => {
        // Check if the submenu is initially expanded
        const isExpanded = toggle.nextElementSibling.classList.contains('show');
        // Set the initial rotation of the arrow
        toggle.querySelector('.arrow').style.transform = isExpanded ? 'rotate(-180deg)' : 'rotate(0deg)';
        
        toggle.addEventListener('click', () => {
            // Toggle the rotation of the arrow when the submenu is clicked
            toggle.querySelector('.arrow').style.transform = toggle.getAttribute('aria-expanded') === 'true' ? 'rotate(-180deg)' : 'rotate(0deg)';
        });
    });
</script>