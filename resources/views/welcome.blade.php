@extends('layouts.default')


@section('header-class', 'has-map')
@section('breadcrumb', '')
@section('title', __('Accueil'))
@section('hide_title', true)



@section('header-bottom')
    <div class="map height-500px" id="map-homepage"></div>

    <!--============ Hero Form ==========================================================================-->

    {!! Form::open(['route' => 'events.index', 'method' => 'get', 'class' => 'hero-form form']) !!}
    <div class="container">
        <!--Main Form-->
        <div class="main-search-form">
            <div class="form-row">

                <!--end col-md-3-->
                <div class="col-md-9 col-sm-9">
                    <div class="form-group">
                        <label for="input-location" class="col-form-label">@lang('Rechercher un événement')</label>
                        <input name="location" type="text" class="form-control" id="input-location"
                               placeholder="@lang('Lieu, Ville, Code postal')">
                        <span class="geo-location input-group-addon" data-toggle="tooltip" data-placement="top"
                              title="Find My Position"><i class="fa fa-map-marker"></i></span>
                    </div>
                    <!--end form-group-->
                </div>

                <!--end col-md-3-->
                <div class="col-md-3 col-sm-3">
                    <button type="submit" class="btn btn-primary width-100">@lang('Rechercher')</button>
                </div>
                <!--end col-md-3-->
            </div>
            <!--end form-row-->
        </div>
        <!--end main-search-form-->
    </div>
    <!--end container-->
    {!! Form::close() !!}
    <!--============ End Hero Form ======================================================================-->

@endsection


@section('content')
    <div class="container">
        <section>

            <div class="gallery-carousel-thumbs owl-carousel" align="center" style="font-size: 18px">

                <p><br><br><i>« Je fête Noël avec mes deux grands enfants et je souhaite partager ce moment avec une
                        autre famille ».</i><br><br> Nathalie, 48 ans, Paris.</p>

                <p><br><br><i>« Mon conjoint, mes enfants et moi-même serions heureux de partager le réveillon de Noël
                        avec une personne seule car ce moment devrait être un moment de joie pour tous. »</i><br><br>
                    Maya, 34
                    ans, Loire Atlantique</p>

                <p><br><br><i>« Venez passer la veille de Noël chez moi en toute simplicité. »</i><br><br> Alexandra, 28
                    ans, Toulouse
                </p>

            </div>

            <br>
            <br>

            <div class="row">
                <div class="col-xl-5 box centerFlex">
                    <form action="/" method="post" class="form" id="forSondage">
                        <h2>Participez à notre sondage</h2>
                        <h3>Je suis seul(e) à Noël parce que : </h3>

                        <div id="formActive" class="form-group options">
                            {{csrf_field()}}
                            <div style="display: inline-grid;grid-template-columns: 30px 1fr;">
                                <input class="checkboxForm" id="1" type="checkbox" name="sondage[]" value="0">
                                <label for="1">Je suis en rupture familiale.<br></label>

                                <input class="checkboxForm" id="2" type="checkbox" name="sondage[]" value="1">
                                <label for="2">Je suis éloigné(e) géographiquement de ma famille.<br></label>

                                <input class="checkboxForm" id="3" type="checkbox" name="sondage[]" value="2">
                                <label for="3">Je suis séparé(e).<br></label>

                                <input class="checkboxForm" id="4" type="checkbox" name="sondage[]" value="3">
                                <label for="4">Je suis veuf/veuve.<br></label>

                                <input class="checkboxForm" id="5" type="checkbox" name="sondage[]" value="4">
                                <label for="5">Je trouve que c’est une fête trop commerciale et je souhaite revenir aux
                                    vraies valeurs de Noël.</label>

                                <input class="checkboxForm" id="6" type="checkbox" name="sondage[]" value="5">
                                <label for="6">Je travaille le jour de Noël.<br></label>

                                <input class="checkboxForm" id="7" type="checkbox" name="sondage[]" value="6">
                                <label for="7">Autre ...<br></label>
                            </div>

                            <button type="submit" class="btn btn-primary icon width-100" style="top: 25px;">Valider<i
                                        class="fa fa-chevron-right"></i></button>

                        </div>
                        <div style="cursor: default;" class="ok_message btn btn-success width-100">
                            <span>Merci d'avoir participé.</span>
                        </div>
                        <div style="cursor: default;" class="error_message">
                            <span></span>
                        </div>

                    </form>
                </div>

                <div class="col-xl-1" style="height: 10rem"></div>

                <div class="col-xl-6 box" align="center" style="margin:auto;">
                    <iframe width="500" height="315" src="https://www.youtube.com/embed/HCIzmXQ9iqU?rel=0"
                            frameborder="0"
                            allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>

            <br>
            <br>


            <div class="gallery-carousel-thumbs owl-carousel" style="font-size: 18px">

                <p><br><br>Sur internet on trouve de nombreux témoignages de personnes seules à Noël...
                    Savez-vous que près de 2 Français sur 10 affirment se sentir seuls au moment des
                    fêtes de fin d’année ? Les fêtes de Noël sont une période de l’année où les
                    personnes se disent les plus affectées par le sentiment de solitude. La première
                    raison est un contexte familial difficile, puis vient l’éloignement géographique. Les
                    statistiques explosent dans les villes où 25% des personnes interrogées révèlent ne
                    pas fêter Noël. Encore plus déroutant, 74% des Français estiment la vraie
                    signification de Noël a été oubliée ...</p>
                <p><br><br>Être seul(e) au moment des fêtes de fin d’année ne doit plus être une fatalité. Que
                    vous soyez célibataire, famille monoparentale, divorcé(e), veuf ou veuve, étudiant(e)
                    Erasmus, éloigné(e) de votre famille ou en rupture familiale, quelque soit votre âge
                    ou votre nationalité, et où que vous soyez, partout en France ou à l’étranger, vous
                    pouvez rejoindre la communauté.</p>
                <p><br><br>Grâce au site Seul Pour Noël, redonner des couleurs à vos fêtes de fin d’année.
                    Comment ça marche ? Créez votre profil, organisez vos festivités, concoctez votre
                    menu et envoyez des invitations à d’autres personnes seules. Pour le reste, laissons
                    la magie de Noël opérer...</p>

            </div>


        </section>

        <section class="block section-press">
            <div class="container">
                <h2>@lang('Ils parlent de nous !')</h2>

                <div class="logos">
                    <a href="http://www.bfmtv.com/mediaplayer/video/comment-eviter-de-passer-les-fetes-tout-seul-724704.html"
                       target="_blank"><img src="/img/press/logo-bfmtv.png" alt="Seul Pour Noël BFM TV" height="55"></a>
                    <a href="http://www.europe1.fr/societe/que-faire-si-lon-est-seul-pendant-les-fetes-2639629"
                       target="_blank"><img src="/img/press/logo-europe1.png" alt="Seul Pour Noël Europe 1" height="55"></a>
                    <a href="http://france3-regions.francetvinfo.fr/alsace/strasbourg-ne-restez-pas-seul-noel-890629.html"
                       target="_blank"><img src="/img/press/logo-france3-ge.png" alt="Seul Pour Noël France TV"
                                            height="55"></a>
                    <a href="http://www.20minutes.fr/strasbourg/1754451-20151221-strasbourg-site-internet-etre-seul-noel"
                       target="_blank"><img src="/img/press/logo-20minutes.png" alt="Seul Pour Noël 20 minutes"
                                            height="55"></a>

                    <a href="http://www.dna.fr/edition-de-strasbourg/2015/12/24/un-site-pour-ne-pas-passer-les-reveillons-seul"
                       target="_blank"><img src="/img/press/logo-dna.png" alt="Seul Pour Noël DNA" height="55"></a>

                    <a href="http://www.estrepublicain.fr/actualite/2015/12/23/rencontres-de-noel-sur-la-toile"
                       target="_blank"><img src="/img/press/logo-lest-republicain.png"
                                            alt="Seul Pour Noël L'est Républicain" height="55"></a>

                    <a href="http://www.leprogres.fr/jura/2015/12/24/seul-a-noel-le-site-de-cette-jurassienne-est-pour-vous"
                       target="_blank"><img src="/img/press/logo-leprogres.png" alt="Seul Pour Noël Le progres"
                                            height="55"></a>

                    <a href="http://www.voixdujura.fr/les-jurassiens-ne-feteront-pas-noel-tout-seuls-cette-annee-64042_15930/"
                       target="_blank"><img src="/img/press/logo-voixdujura.png" alt="Seul Pour Noël Voix du Jura"
                                            height="55"></a>
                    <a href="http://www.tntv.pf/Metropole-ne-restez-pas-seul-pour-Noel_a9340.html" target="_blank"><img
                                src="/img/press/logo-tntvnews.png" alt="Seul Pour Noël TNTV News" height="55"></a>
                    {{--<a href="http://www.alsace20.tv/VOD/Actu/6-minutes-eurometropole/Seul-pour-Noel-appli-Strasbourgeoise-pour-ne-pas-passer-fetes-seuls-jhxs5P40Bj.html"--}}
                    {{--target="_blank"><img src="/img/press/logo-alsace20.png" alt="Seul Pour Noël Alsace 20"--}}
                    {{--height="55"></a>--}}


                </div>

            </div>

        </section>

    </div>
@endsection



@section('scripts')

    <script src="/theme/js/markerclusterer_packed.js"></script>
    <script src="/theme/js/richmarker-compiled.js"></script>
    <script src="/theme/js/infobox.js"></script>
    <script src="/theme/js/map.js"></script>
    <script src="/theme/js/sondage.js"></script>
    <script>
        var latitude = 46.4481592;
        var longitude = 2.3115606;
        var mapElement = "map-homepage";
        var mapDefaultZoom = 6;
        var mapAutoZoom = false;
        heroMap(latitude, longitude, mapElement, mapDefaultZoom, mapAutoZoom);
    </script>
    <script>

    </script>

@endsection



