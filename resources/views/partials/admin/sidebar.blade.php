<!-- Left Sidebar -->
<div class="left main-sidebar">

    <div class="sidebar-inner leftscroll">

        <div id="sidebar-menu">

            <ul>

                <li class="submenu">
                    <a
                        href="{{ route('admin.products') }}"
                        class="{{ Helper::navigation_selected('admin.products') }}"
                    >
                        <i class="fa fa-fw fa-balance-scale"></i>
                        <span>{{ __("Productos") }}</span>
                    </a>
                </li>

                <li class="submenu">
                    <a
                        href="{{ route('admin.orders') }}"
                        class="{{ Helper::navigation_selected('admin.orders') }}"
                    >
                        <i class="fa fa-fw fa-fire"></i>
                        <span>{{ __("Pedidos") }}</span>
                    </a>
                </li>

                <li class="submenu">
                    <a
                        href="{{ route('admin.promotions') }}"
                        class="{{ Helper::navigation_selected('admin.promotions') }}"
                    >
                        <i class="fa fa-fw fa-gift"></i>
                        <span>{{ __("Promociones") }}</span>
                    </a>
                </li>
            </ul>

        </div>

    </div>

</div>
<!-- End Sidebar -->