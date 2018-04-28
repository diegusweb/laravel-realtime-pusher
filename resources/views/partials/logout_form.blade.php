<a
    href="{{ route('logout') }}"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
    class="dropdown-item notify-item"
>
    <i class="fa fa-power-off"></i>
    <span>{{ __("Cerrar sesión") }}</span>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</a>