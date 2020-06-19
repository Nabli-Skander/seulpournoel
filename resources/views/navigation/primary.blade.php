<ul class="navbar-nav">


    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            @lang('Accueil')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('help') }}">
            @lang('Aide')
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dashboard.events.create') }}" class="btn btn-primary text-caps btn-rounded btn-framed">
            @lang('Devenir hôte')
        </a>
    </li>

    @if (count(LaravelLocalization::getSupportedLocales()) > 1)
        <li class="nav-item dropdown language-selector">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <img src="/img/flags/{{ LaravelLocalization::getCurrentLocale() }}.png"/>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        <img src="/img/flags/{{ $localeCode }}.png"/> <span>{{ $properties['native'] }}</span>
                    </a>
                @endforeach


            </div>
        </li>
    @endif

</ul>
