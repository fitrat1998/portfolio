<!-- Navbar Start -->
<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</small>
            <small class="ms-4"><i class="fa fa-clock text-primary me-2"></i>9.00 am - 9.00 pm</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small><i class="fa fa-envelope text-primary me-2"></i>info@example.com</small>
            <small class="ms-4"><i class="fa fa-phone-alt text-primary me-2"></i>+012 345 6789</small>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ route('index') }}" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="display-5 text-primary m-0">Finanza</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('index') }}" class="nav-item nav-link {{ request()->routeIs('index') ? 'active' : '' }}">{{ __('local.home') }}</a>
                <a href="{{ route('abouts.index') }}" class="nav-item nav-link {{ request()->routeIs('abouts.index') ? 'active' : '' }}">{{ __('local.about') }}</a>
                <a href="{{ route('services.index') }}" class="nav-item nav-link {{ request()->routeIs('services.index') ? 'active' : '' }}">{{ __('local.services') }}</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle {{ request()->routeIs('projects.index','features.index','teams.index','testimonials.index','notFounds.index') ? 'active' : '' }}" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu border-light m-0">
                        <a href="{{ route('projects.index') }}" class="dropdown-item {{ request()->routeIs('projects.index') ? 'active' : '' }}">Projects</a>
                        <a href="{{ route('features.index') }}" class="dropdown-item {{ request()->routeIs('features.index') ? 'active' : '' }}">Features</a>
                        <a href="{{ route('teams.index') }}" class="dropdown-item {{ request()->routeIs('teams.index') ? 'active' : '' }}">Team Member</a>
                        <a href="{{ route('testimonials.index') }}" class="dropdown-item {{ request()->routeIs('testimonials.index') ? 'active' : '' }}">Testimonial</a>
                        <a href="{{ route('notfounds.index') }}" class="dropdown-item {{ request()->routeIs('notfounds.index') ? 'active' : '' }}">404 Page</a>
                    </div>
                </div>
                <a href="{{ route('contacts.index') }}" class="nav-item nav-link {{ request()->routeIs('contacts.index') ? 'active' : '' }}">{{ __('local.contact') }}</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" id="langDropdown">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-end m-0" aria-labelledby="langDropdown">
                        <a href="{{ route('lang.switch', 'en') }}" class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">English</a>
                        <a href="{{ route('lang.switch', 'uz') }}" class="dropdown-item {{ app()->getLocale() == 'uz' ? 'active' : '' }}">O‘zbekcha</a>
                        <a href="{{ route('lang.switch', 'ru') }}" class="dropdown-item {{ app()->getLocale() == 'ru' ? 'active' : '' }}">Русский</a>
                    </div>
                </div>

            </div>
            <div class="d-none d-lg-flex ms-2">
                <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                    <small class="fab fa-facebook-f text-primary"></small>
                </a>
                <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                    <small class="fab fa-twitter text-primary"></small>
                </a>
                <a class="btn btn-light btn-sm-square rounded-circle ms-3" href="">
                    <small class="fab fa-linkedin-in text-primary"></small>
                </a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.querySelector('#langDropdown');
        const dropdownMenu = dropdownToggle.nextElementSibling;

        dropdownToggle.addEventListener('click', function(e) {
            e.preventDefault();
            // Agar dropdown ochiq bo‘lsa → yopish, aks holda ochish
            dropdownMenu.classList.toggle('show');
        });

        // Boshqa joyga bosilganda yopish
        document.addEventListener('click', function(e) {
            if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    });
</script>