<div class="row">
    <div class="col-md-6 col-sm-6">
        <nav>
            <ul class="list-unstyled">
                <li>
                    <a href="{{ route('home') }}">
                        @lang('Accueil')
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.events.create') }}">
                        @lang('Devenir hôte')
                    </a>
                </li>


                @guest
                    <li><a href="{{ route('login') }}">@lang('Connexion')</a></li>
                    <li><a href="{{ route('register') }}">@lang('Inscription')</a></li>
                @endguest

                @auth
                    <li>
                        <a href="{{ route('dashboard.events.index') }}">@lang('Mes évenements')</a>
                    </li>


                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            @lang('Déconnexion')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endauth


            </ul>
        </nav>
    </div>
    <div class="col-md-6 col-sm-6">
        <nav>
            <ul class="list-unstyled">

                <li>
                    <a href="{{ route('help') }}">
                        @lang('Aide')
                    </a>
                </li>
                <li>
                    <a href="{{ route('legal') }}">
                        @lang('Mentions légales')
                    </a>
                </li>
                <li>
                    <a href="{{ route('terms') }}">
                        @lang('Conditions Générales d\'Utilisation')
                    </a>
                </li>


            </ul>
        </nav>
    </div>
</div>