<header class="hero @yield('header-class')">
    <div class="hero-wrapper">
        <!--============ Secondary Navigation ===============================================================-->
        <div class="secondary-navigation">
            <div class="container">
            @include('navigation.secondary')
            <!--end right-->
            </div>
            <!--end container-->
        </div>
        <div class="main-navigation">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="/img/logo_{{LaravelLocalization::getCurrentLocale()}}.png" alt="Seul Pour Noeël"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <!--Main navigation list-->
                    @include('navigation.primary')
                    <!--Main navigation list-->
                    </div>
                </nav>
                {{--
                <!--end navbar-->
                @section('breadcrumb')
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Library</a></li>
                    <li class="breadcrumb-item active">Data</li>
                                                   </ol>
                <!--end breadcrumb-->
                @show --}}
            </div>
        </div>
        @if (View::hasSection('title') && !View::hasSection('hide_title'))
            <div class="page-title">
                <div class="container">
                    <h1>@yield('title')</h1>
                </div>
            </div>
        @endif
        <div class="background"></div>
    </div>
    @yield('header-bottom')
</header>
