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
            <li class="nav-item mb-1 {{ request()->is('appointments-calendar') ? 'active' : '' }}">
                <a class="nav-link p-2" href="{{ route('user.appointments.calendar') }}">
                    <i class="me-1 fas fa-calendar-alt"></i>
                    Calendars
                </a>
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
            <li class="nav-item mb-1 {{ request()->is('profile*') ? 'active' : '' }}">
                <a class="nav-link p-2 " href="{{ route('profile.index') }}"  role="button">
                    <i class="me-1 fas fa-cog"></i>
                    Settings
                </a>
            </li>
        </ul>

    </div>

    <div class="row mt-5 mb-3">
        <div class="col-12 text-center">
            <button class="btn btn-light btn-sm copy-link-btn w-100" style="color:#1642B9;"
                data-link="{{ url('/') }}/service-booking/{{auth()->user()->id}}"
                data-toggle="tooltip" title="Copy link to this service to share with customers.">
                <i class="fas fa-user me-2"></i>
                Get your appointment link
            </button>
        </div>
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

    let copyLinkBtn = document.querySelector('.copy-link-btn');
    copyLinkBtn.addEventListener('click', function() {
        var link = this.getAttribute('data-link');
        // Create a temporary input element
        var tempInput = document.createElement('input');
        tempInput.value = link;
        document.body.appendChild(tempInput);

        // Select the input field
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); /* For mobile devices */

        // Copy the text inside the input field
        document.execCommand('copy');

        // Remove the temporary input element
        document.body.removeChild(tempInput);
        $("#liveToast").toast("show");
    });
</script>