@extends('layouts.dashboard')

@section('title', __('Admin'))

@section('dashboard-content')

    <h2>@lang('Utilisateurs')</h2>
    <p>Il y a {{ $usersCount }} @lang('inscrits sur le site').</p>
    <a class="btn small btn-success" href="{{ route('admin.export.users') }}">@lang('Exporter')</a>
    <br>
    <br>
    <h2>@lang('Événements')</h2>
    <p>Il y a {{ $eventsCount }} @lang('événements créés sur le site.')</p>
    <a class="btn small btn-success" href="{{ route('admin.export.events') }}">@lang('Exporter')</a>
    <br>
    <br>
    <h2>@lang('Sondage')</h2>
    <h3>Je suis seul(e) à Noël parce que :</h3>
    <p>Il y a {{ $sondageCount }} @lang('participant au sondage.')</p>
    <ul class="skills-list">
        <li class="skill-item">
            <h3 class="skill-title">Je suis en rupture familiale.</h3>
            <figure class="skill-figure" data-taux="{{$sondage[0]}}" data-color="0">
                <figcaption class="skill-caption">
                    <output class="skill-output"></output>
                </figcaption>
            </figure>
        </li>
        <li class="skill-item">
            <h3 class="skill-title">Je suis éloigné(e) géographiquement de ma famille.</h3>
            <figure class="skill-figure" data-taux="{{$sondage[1]}}" data-color="0">
                <figcaption class="skill-caption">
                    <output class="skill-output"></output>
                </figcaption>
            </figure>
        </li>
        <li class="skill-item">
            <h3 class="skill-title">Je suis séparé(e).</h3>
            <figure class="skill-figure" data-taux="{{$sondage[2]}}" data-color="0">
                <figcaption class="skill-caption">
                    <output class="skill-output"></output>
                </figcaption>
            </figure>
        </li>
        <li class="skill-item">
            <h3 class="skill-title">Je suis veuf/veuve.</h3>
            <figure class="skill-figure" data-taux="{{$sondage[3]}}" data-color="0">
                <figcaption class="skill-caption">
                    <output class="skill-output"></output>
                </figcaption>
            </figure>
        </li>
        <li class="skill-item">
            <h3 class="skill-title">Je trouve que c’est une fête trop commerciale et je souhaite revenir aux vraies valeurs de Noël.</h3>
            <figure class="skill-figure" data-taux="{{$sondage[4]}}" data-color="0">
                <figcaption class="skill-caption">
                    <output class="skill-output"></output>
                </figcaption>
            </figure>
        </li>
        <li class="skill-item">
            <h3 class="skill-title">Je travaille le jour de Noël.</h3>
            <figure class="skill-figure" data-taux="{{$sondage[5]}}" data-color="0">
                <figcaption class="skill-caption">
                    <output class="skill-output"></output>
                </figcaption>
            </figure>
        </li>
        <li class="skill-item">
            <h3 class="skill-title">Autre</h3>
            <figure class="skill-figure" data-taux="{{$sondage[6]}}" data-color="0">
                <figcaption class="skill-caption">
                    <output class="skill-output"></output>
                </figcaption>
            </figure>
        </li>

    </ul>



@endsection

@section('scripts')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
    <script src="/theme/js/sondage.js"></script>


@endsection