<!-- Left Sidebar -->
<div class="left main-sidebar">

    <div class="sidebar-inner leftscroll">

        <div id="sidebar-menu">

            <ul>

                <li class="submenu">
                    <a class="{{ Helper::navigation_selected('home') }}" href="{{ route('home') }}">
                        <i class="fa fa-fw fa-free-code-camp"></i>
                        <span>{{ __("Inicio") }}</span>
                    </a>
                </li>

                <li class="submenu">
                    <a class="{{ Helper::navigation_selected('login') }}" href="{{ route('login') }}">
                        <i class="fa fa-fw fa-user-circle"></i>
                        <span>{{ __("Iniciar sesión") }}</span>
                    </a>
                </li>

                <li class="submenu">
                    <a class="{{ Helper::navigation_selected('register') }}" href="{{ route('register') }}">
                        <i class="fa fa-fw fa-user-plus"></i>
                        <span>{{ __("Registrarme") }}</span>
                    </a>
                </li>

            </ul>

        </div>

    </div>

</div>
<!-- End Sidebar -->