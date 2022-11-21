<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
{{--            @can('user_management_access')--}}
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ __('menu.students') }}
                    </a>
                    <ul class="nav-dropdown-items">
{{--                        @can('permission_access')--}}
                            <li class="nav-item">
                                <a href="{{ route("users.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa fa-address-card-o nav-icon">

                                    </i>
                                    {{ __('menu.manage') }}
                                </a>
                            </li>
{{--                        @endcan--}}
{{--                        @can('role_access')--}}
                            <li class="nav-item">
                                <a href="{{ route("users.create") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa fa-plus-circle nav-icon">

                                    </i>
                                    {{ __('menu.add') }}
                                </a>
                            </li>
{{--                        @endcan--}}
                    </ul>
                </li>
{{--            @endcan--}}
{{--            @can('asset_access')--}}
                <li class="nav-item">
                    <a href="{{ route("lessons.index") }}" class="nav-link {{ request()->is('admin/assets') || request()->is('admin/assets/*') ? 'active' : '' }}">
                        <i class="fa fa-book nav-icon">

                        </i>
                        {{ __('menu.lessons') }}
                    </a>
                </li>
{{--            @endcan--}}
{{--            @can('stock_access')--}}
                <li class="nav-item">
                    <a href="{{ route("evaluations.index") }}" class="nav-link {{ request()->is('admin/stocks') || request()->is('admin/stocks/*') ? 'active' : '' }}">
                        <i class="fa fa-sort-numeric-asc nav-icon">

                        </i>
                        {{ __('menu.evaluations') }}
                    </a>
                </li>
{{--            @endcan--}}
{{--            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))--}}
{{--                @can('profile_password_edit')--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">--}}
{{--                            <i class="fa-fw fas fa-key nav-icon">--}}
{{--                            </i>--}}
{{--                            {{ __('global.change_password') }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endcan--}}
{{--            @endif--}}
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ __('menu.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
