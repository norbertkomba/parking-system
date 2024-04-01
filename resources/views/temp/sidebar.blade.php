<div id="sidebar" class="sidebar  responsive  ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <ul class="nav nav-list">
        <li class="{{ request()->segment(1)=='dashboard' ? 'active' : '' }}">
            <a href="{{ url('dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>

        @canany(["manage user", "manage group"])
            <li class="{{ request()->segment(1)=='permission-group' ? 'active open' : '' }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-user-secret"></i>
                    <span class="menu-text">
                        Logs & Access
                    </span>

                    <b class="arrow fa fa-angle-{{ request()->segment(1)=='permission-group' ? 'down' : 'left' }}"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu {{ request()->segment(1)=='permission-group' ? 'nav-show' : '' }}">
                    @can('manage user')
                        <li class="{{ request()->routeIs('activity.list') ? "active" : '' }}">
                            <a href="">
                                <i class="menu-icon fa fa-user-secret"></i>
                                Users
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endcan

                    @can('create group')
                        <li class="{{ request()->routeIs('permission.cu_group') ? "active" : '' }}">
                            <a href="">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Groups
                            </a>
                            <b class="arrow"></b>
                        </li>

                        <li class="{{ request()->routeIs('permission.list') ? "active" : '' }}">
                            <a href="">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Permissions
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(["manage card", "manage device"])
            <li class="{{ request()->segment(1)=='card-device' ? 'active open' : '' }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-hdd-o"></i>
                    <span class="menu-text">
                        Device & Card
                    </span>

                    <b class="arrow fa fa-angle-{{ request()->segment(1)=='card-device' ? 'down' : 'left' }}"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu {{ request()->segment(1)=='card-device' ? 'nav-show' : '' }}">
                    @can('manage card')
                        <li class="{{ request()->routeIs('card.manage') ? "active" : '' }}">
                            <a href="{{ route('card.manage') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Card
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endcan


                    @can('manage device')
                        <li class="{{ request()->routeIs('device.manage') ? "active" : '' }}">
                            <a href="{{ route('device.manage') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Device
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @canany(["manage rate", "manage category"])
            <li class="{{ request()->segment(1)=='rate-category' ? 'active open' : '' }}">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-cubes"></i>
                    <span class="menu-text">
                        Rate & Category
                    </span>

                    <b class="arrow fa fa-angle-{{ request()->segment(1)=='rate-category' ? 'down' : 'left' }}"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu {{ request()->segment(1)=='rate-category' ? 'nav-show' : '' }}">
                    @can('manage rate')
                        <li class="{{ request()->routeIs('rate.manage') ? "active" : '' }}">
                            <a href="{{ route('rate.manage') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Rate
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endcan


                    @can('manage category')
                        <li class="{{ request()->routeIs('category.manage') ? "active" : '' }}">
                            <a href="{{ route('category.manage') }}">
                                <i class="menu-icon fa fa-caret-right"></i>
                                Category
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @can('manage vehicle')
        <li class="{{ request()->segment(1)=='vehicle' ? 'active open' : '' }}">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-automobile"></i>
                <span class="menu-text">
                    Manage Vehicle
                </span>

                <b class="arrow fa fa-angle-{{ request()->segment(1)=='vehicle' ? 'down' : 'left' }}"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu {{ request()->segment(1)=='vehicle' ? 'nav-show' : '' }}">
                @can('manage rate')
                    <li class="{{ request()->routeIs("vehicle.manage") ? "active" : '' }}">
                        <a href="{{ route("vehicle.manage") }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Vehicle Entry
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endcan


                @can('manage category')
                    <li class="{{ request()->routeIs('vehicle.check-in') ? "active" : '' }}">
                        <a href="{{ route('vehicle.check-in') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Check In
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endcan

                @can('manage category')
                    <li class="{{ request()->routeIs('vehicle.check-out') ? "active" : '' }}">
                        <a href="{{ route('vehicle.check-out') }}">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Check Out
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endcan
            </ul>
        </li>
        @endcan
    </ul>
</div>
