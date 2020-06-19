<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/img/fav/apple-touch-icon-57x57.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/fav/apple-touch-icon-114x114.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/fav/apple-touch-icon-72x72.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/img/fav/apple-touch-icon-144x144.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/img/fav/apple-touch-icon-60x60.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/img/fav/apple-touch-icon-120x120.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/img/fav/apple-touch-icon-76x76.png"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/img/fav/apple-touch-icon-152x152.png"/>
    <link rel="icon" type="image/png" href="/img/fav/favicon-196x196.png" sizes="196x196"/>
    <link rel="icon" type="image/png" href="/img/fav/favicon-96x96.png" sizes="96x96"/>
    <link rel="icon" type="image/png" href="/img/fav/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/img/fav/favicon-16x16.png" sizes="16x16"/>
    <link rel="icon" type="image/png" href="/img/fav/favicon-128.png" sizes="128x128"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="/img/fav/mstile-144x144.png"/>
    <meta name="msapplication-square70x70logo" content="/img/fav/mstile-70x70.png"/>
    <meta name="msapplication-square150x150logo" content="/img/fav/mstile-150x150.png"/>
    <meta name="msapplication-wide310x150logo" content="/img/fav/mstile-310x150.png"/>
    <meta name="msapplication-square310x310logo" content="/img/fav/mstile-310x310.png"/>
    <meta property="og:image" content="{{URL::asset('img/preview.png') }}"/>
    <meta property="og:description"
          content="@lang('Site de mise en relation des personnes seules à Noël. Création d\'événements. Inscription gratuite et sécurisée.')"/>
    <meta name="title" content="@lang('Seul pour Noël')">
    <meta name="description"
          content="@lang('Site de mise en relation des personnes seules à Noël. Création d\'événements. Inscription gratuite et sécurisée.')">
    <meta name="keywords" content="seul pour noel, seul, noel, événement">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="French">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="/vendor/noty/noty.css">
    <link rel="stylesheet" href="/theme/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/theme/fonts/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="/theme/css/selectize.css" type="text/css">
    <link rel="stylesheet" href="/theme/css/style.css">
    <link rel="stylesheet" href="/theme/css/user.css">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/theme/css/owl.carousel.min.css">

    @if(View::hasSection('title'))
        <title>@yield('title') - @lang('Seul pour Noël')</title>
    @else
        <title>Seul pour Noël</title>
    @endif



    @yield('head')
    @yield('styles')
</head>
<body>

<div class="page home-page">
    <!--*********************************************************************************************************-->
    <!--************ HERO ***************************************************************************************-->
    <!--*********************************************************************************************************-->

@include('header')
<!--*********************************************************************************************************-->
    <!--************ CONTENT ************************************************************************************-->
    <!--*********************************************************************************************************-->
    <section class="content">
        @yield('content')
    </section>

    </section>
    <!--end content-->

    <!--*********************************************************************************************************-->
    <!--************ FOOTER *************************************************************************************-->
    <!--*********************************************************************************************************-->
@include('footer')
<!--end footer-->
</div>
<!--end page-->

{{--<script src="/theme/js/jquery-3.2.1.min.js"></script>--}}
{{--<script type="text/javascript" src="/theme/js/popper.min.js"></script>--}}
{{--<script type="text/javascript" src="/theme/bootstrap/js/bootstrap.min.js"></script>--}}
{{--<script type="text/javascript"--}}
{{--src="http://maps.google.com/maps/api/js?key=AIzaSyBEDfNcQRmKQEyulDN8nGWjLYPm8s4YB58&libraries=places"></script>--}}
{{--<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>-->--}}
{{--<script src="/theme/js/selectize.min.js"></script>--}}
{{--<script src="/theme/js/masonry.pkgd.min.js"></script>--}}
{{--<script src="/theme/js/icheck.min.js"></script>--}}
{{--<script src="/theme/js/jquery.validate.min.js"></script>--}}
{{--<script src="/theme/js/markerclusterer_packed.js"></script>--}}
{{--<script src="/theme/js/infobox.js"></script>--}}
{{--<script src="/theme/js/richmarker-compiled.js"></script>--}}
{{--<script src="/theme/js/map.js"></script>--}}
{{--<script src="/theme/js/custom.js"></script>--}}


<script src="/theme/js/jquery.3.3.1.min.js"></script>
<script type="text/javascript" src="/theme/js/popper.min.js"></script>
<script type="text/javascript" src="/theme/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY')  }}&libraries=places"></script>
<script src="/theme/js/selectize.min.js"></script>
<script src="/theme/js/masonry.pkgd.min.js"></script>
<script src="/theme/js/icheck.min.js"></script>
<script src="/theme/js/jquery.validate.min.js"></script>
<script src="/theme/js/jQuery.MultiFile.min.js"></script>
<script src="/theme/js/owl.carousel.min.js"></script>
<script src="/theme/js/custom.js"></script>
<script src="/vendor/noty/noty.min.js"></script>

<script>


    $(document).ready(function () {

        @if($errors->any())
        @foreach ($errors->all() as $error)
        new Noty({
            type: 'error',
            layout: 'topCenter',
            text: '{{ $error }}'
        }).show();
        @endforeach
        @endif


        @if(Session::has('success'))
        new Noty({
            type: 'success',
            layout: 'topCenter',
            text: '{{ Session::get('success') }}',
            timeout: 3000
        }).show();
        @endif
        @if(Session::has('information'))
        new Noty({
            type: 'information',
            layout: 'topCenter',
            text: '{{ Session::get('information') }}',
            timeout: 3000
        }).show();
        @endif
        @if(Session::has('error'))
        new Noty({
            type: 'error',
            layout: 'topCenter',
            text: '{{ Session::get('error') }}',
            timeout: 3000
        }).show();
        @endif
        @if(Session::has('warning'))
        new Noty({
            type: 'warning',
            layout: 'topCenter',
            text: '{{ Session::get('warning') }}',
            timeout: 3000
        }).show();
        @endif
    });
</script>
@yield('scripts')
</body>
</html>
