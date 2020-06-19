<ul class="navbar-nav">
    @if (Route::has('login'))
        @auth
            <li class="nav-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                Déconnexion
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endauth
    @else
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endif

    <li class="nav-item">
        <a class="nav-link"
           href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), route('home')) }}">
            {{ __('custom.home') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link"
           href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(), route('help')) }}">
            {{ __('custom.help') }}
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('/event/create') }}" class="btn btn-primary text-caps btn-rounded btn-framed">
            {{ __('custom.become_host') }}
        </a>
    </li>
</ul>
