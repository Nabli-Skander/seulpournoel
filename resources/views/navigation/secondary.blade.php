<ul class="left">
    <li>
        <i class="fa fa-envelope-o"></i> <a
                href="&#x6d;&#x61;&#x69;&#x6c;&#116;&#x6f;&#x3a;&#x74;&#101;&#x61;&#109;&#64;&#x73;&#101;&#x75;&#108;&#112;&#111;&#117;&#x72;&#110;&#x6f;&#101;&#x6c;&#x2e;&#x66;&#114;">@lang('Contactez-nous')</a>

    </li>
</ul>
<!--end left-->
<ul class="right">


    @guest
        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i>@lang('Connexion')</a></li>
        <li><a href="{{ route('register') }}"><i class="fa fa-pencil-square-o"></i>@lang('Inscription')</a></li>
    @endguest

    @auth
        <li>
            <a href="{{ route('profile.edit') }}">
                <i class="fa fa-user"></i> @lang('Mon profil')
            </a>
        </li>

            <li>
                <a href="{{ route('conversations') }}">
                    <i class="fa fa-envelope"></i> @lang('Messagerie')
                </a>
            </li>

        <li>
            <a href="{{ route('dashboard.events.index') }}">
                <i class="fa fa-heart"></i>@lang('Mes événements')
            </a>
        </li>

        <li>
            <a href="{{ route('invitations.index') }}">
                <i class="fa fa-user-plus"></i>@lang('Mes invitations')
            </a>
        </li>

        @if (Auth::user() && Auth::user()->isAdmin())

            <li>
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-flag"></i> @lang('Administration')
                </a>
            </li>
        @endif
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-in"></i>@lang('Déconnexion')
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    @endauth
</ul>
