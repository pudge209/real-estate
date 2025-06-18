<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <!-- Dashboard -->
            <li class="sidebar-item @if(Route::currentRouteName() == 'admin.dashboard') active @endif">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="home"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <!-- Users Panel -->
            <li class="sidebar-item @if(Route::currentRouteName() == 'admin.index') active @endif">
                <a class="sidebar-link" href="{{ route('admin.index') }}">
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Users Panel</span>
                </a>
            </li>

            <!-- Offices -->
            <li class="sidebar-item @if(Route::currentRouteName() == 'admin.offices') active @endif">
                <a class="sidebar-link" href="{{ route('admin.offices') }}">
                    <i class="align-middle" data-feather="briefcase"></i>
                    <span class="align-middle">Offices</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
