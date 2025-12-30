<!-- Sidebar -->
<aside class="admin-sidebar" id="admin-sidebar">
    <div class="sidebar-content">
        <nav class="sidebar-nav">
            <ul class="nav flex-column">

                <!-- 1) Asosiy -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}"
                        href="{{ route('index') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Bosh sahifa
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pages.index') ? 'active' : '' }}"
                        href="{{ route('pages.index') }}">
                        <i class="fas fa-folder-open"></i> Sahifalar
                    </a>
                </li>

                <!-- 4) Tuzilma -->
                @canany(['roles.show', 'permissions.show', 'users.show'])
                @php
                $structureActive =
                request()->is('roles*') ||
                request()->is('permissions*') ||
                request()->is('users*');
                @endphp

                <li class="nav-item">
                    <button
                        class="menu-toggle nav-link d-flex align-items-center {{ $structureActive ? 'active' : '' }}"
                        data-menu="structureMenu">
                        <i class="bi bi-puzzle me-2"></i> Tuzilma
                        <i class="bi bi-chevron-down ms-auto"></i>
                    </button>

                    <div id="structureMenu" class="menu-collapse {{ $structureActive ? 'show' : '' }}">
                        <ul class="nav nav-submenu flex-column ps-3">

                            @can('roles.show')
                            <li><a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}"
                                    href="{{ route('roles.index') }}">
                                    <i class="bi bi-person-gear me-2"></i> Rollar
                                </a></li>
                            @endcan

                            @can('permission.show')
                            <li><a class="nav-link {{ request()->is('permissions*') ? 'active' : '' }}"
                                    href="{{ route('permissions.index') }}">
                                    <i class="bi bi-shield-lock me-2"></i> Ruxsatlar
                                </a></li>
                            @endcan

                            @can('user.show')
                            <li><a class="nav-link {{ request()->is('users*') ? 'active' : '' }}"
                                    href="{{ route('users.index') }}">
                                    <i class="bi bi-shield-lock me-2"></i> Foydalanuvchilar
                                </a></li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany



            </ul>
        </nav>
    </div>
</aside>