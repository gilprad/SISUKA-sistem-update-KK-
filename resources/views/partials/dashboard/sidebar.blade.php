@php
    $dashboardRoute = 'admin.dashboard';

    if (auth()->user()->role === 'verifikator') {
        $dashboardRoute = 'verifikator.dashboard';
    } elseif (auth()->user()->role === 'user') {
        $dashboardRoute = 'user.dashboard';
    }
@endphp

<aside id="sidebar-wrapper">
    <div class="sidebar-brand my-3">
        <img src="{{ asset('assets/img/stisla.svg') }}" class="rounded-circle" style="height: 80px;" alt="{{ config('app.name') }}">
        <br>
        <a href="{{ route($dashboardRoute) }}" class="mb-2">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route($dashboardRoute) }}">SUK</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ request()->routeIs($dashboardRoute) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route($dashboardRoute) }}">
                <i class="fas fa-columns"></i> <span>Dashboard</span>
            </a>
        </li>

        <li class="menu-header">Profile</li>
        <li class="{{ request()->routeIs('profile') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-user-ninja"></i> <span>Profile</span>
            </a>
        </li>

        @role('admin')
            <li class="menu-header">Users</li>
            <li class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.user.index') }}"><i class="fas fa-users"></i> <span>Users</span></a>
            </li>

            <li class="menu-header">Pengajuan</li>
            <li class="{{ request()->routeIs('admin.submission.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.submission.index') }}"><i class="fas fa-file"></i> <span>Pengajuan</span></a>
            </li>

        @endrole

        @role('verifikator')
        <li class="menu-header">Pengajuan</li>
        <li class="{{ request()->routeIs('verifikator.submission.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('verifikator.submission.index') }}"><i class="fas fa-file"></i> <span>Pengajuan</span></a>
        </li>
        @endrole

        @role('user')
        <li class="menu-header">Pengajuan</li>
        <li class="{{ request()->routeIs('user.submission.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.submission.index') }}"><i class="fas fa-file"></i> <span>Pengajuan</span></a>
        </li>
        @endrole
    </ul>
{{--    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">--}}
{{--        <a href="{{ url('/') }}" class="btn btn-primary btn-lg btn-block btn-icon-split">--}}
{{--            <i class="fas fa-home"></i> Home--}}
{{--        </a>--}}
{{--    </div>--}}
</aside>
