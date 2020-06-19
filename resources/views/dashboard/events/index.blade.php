@extends('layouts.dashboard')

@section('title', __('Mes évenements'))

@section('dashboard-content')

    <div class="row">
        <div class="col-lg-12">


            <a href="{{ route('dashboard.events.create') }}"
               class="btn btn-primary small float-right">@lang('Créer un évenement')</a>
        </div>
    </div>
    <br>

    <h2>@lang('Événements des autres utilisateurs')</h2>
    @if (count(\Auth::user()->participations) == 0)
        <div class="alert alert-info" role="alert">
            @lang('Vous ne participez à aucun événement.')<br><br>
            <p>
                <a class="btn btn-info small" href="{{ route('home') }}">
                    @lang('Rechercher un événement')
                </a>
            </p>

        </div>
    @endif
    <div class="items list grid-xl-3-items grid-lg-2-items grid-md-2-items">

        @foreach(\Auth::user()->participations as $event)
            <div class="item">
                <div class="wrapper">
                    <div class="image">
                        <h3>
                            <a href="{{ route('events.show', $event->id) }}" class="title">{{ $event->title }}</a>
                        </h3>
                        <a href="{{ route('events.show', $event->id) }}" class="image-wrapper background-image"
                           style="background-image: url(&quot;assets/img/image-03.jpg&quot;);">
                            <img src="{{$event->imageURL()}}" alt="">
                        </a>
                    </div>
                    <!--end image-->
                    <h4 class="location">
                        <a href="{{route('events.index')}}?location={{ $event->locationShort() }}">{{ $event->city }}
                            , {{ $event->country }}</a>
                    </h4>
                    <div class="meta">
                        @if ($event->pivot->status == 'new')
                            <div class="alert alert-primary">@lang('Demande soumise')</div>
                        @elseif ($event->pivot->status == 'accepted')
                            <div class="alert alert-success">@lang('Demande acceptée')</div>
                        @elseif ($event->pivot->status == 'refused')
                            <div class="alert alert-danger">@lang('Demande refusée')</div>
                        @endif
                    </div>
                    <div class="price">{{ $event->price }} €</div>

                    <!--end admin-controls-->
                    <div class="description">
                        <p>{{ $event->shortDescription() }}</p>
                    </div>
                    <!--end description-->
                    <a href="{{ route('events.show', $event->id) }}"
                       class="detail text-caps underline">@lang('Plus d\'infos')</a>
                </div>
            </div>
            <!--end item-->

        @endforeach


    </div>

    <h2>@lang('Événements que j\'ai créé')</h2>
    @if (count($events) == 0)
        <div class="alert alert-info" role="alert">
            @lang('Vous n\'avez aucun événement.')
        </div>
    @endif
    <div class="items list compact grid-xl-3-items grid-lg-2-items grid-md-2-items">

        @foreach($events as $event)
            <div class="item">
                <div class="wrapper">
                    <div class="image">
                        <h3>
                            <a href="{{ route('events.show', $event->id) }}" class="title">{{ $event->title }}</a>
                        </h3>
                        <a href="{{ route('events.show', $event->id) }}" class="image-wrapper background-image"
                           style="background-image: url(&quot;assets/img/image-03.jpg&quot;);">
                            <img src="{{$event->imageURL()}}" alt="">
                        </a>
                    </div>
                    <!--end image-->
                    <h4 class="location">
                        <a href="{{route('events.index')}}?location={{ $event->locationShort() }}">{{ $event->city }}
                            , {{ $event->country }}</a>
                    </h4>
                    <div class="price">{{ $event->price }} €</div>
                    <div class="admin-controls">
                        <a href="{{ route('dashboard.events.edit', $event->id) }}">
                            <i class="fa fa-pencil"></i> @lang('Modifier')
                        </a>
                        <a href="#" class="remove-event" event-id="{{ $event->id  }}">
                            <i class="fa fa-trash"></i> @lang('Supprimer')
                        </a>
                    </div>
                    <!--end admin-controls-->
                    <div class="description">
                        <p>{{ $event->shortDescription() }}</p>
                    </div>
                    <!--end description-->
                    <a href="{{ route('events.show', $event->id) }}"
                       class="detail text-caps underline">@lang('Plus d\'infos')</a>
                </div>
            </div>
            <!--end item-->

        @endforeach


    </div>
@endsection


@section('styles')
    <link rel="stylesheet" href="/vendor/sweetalert/sweetalert.css">
@endsection

@section('scripts')
    @parent
    <script src="/vendor/sweetalert/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.remove-event').click(function () {
                var eid = $(this).attr('event-id');
                swal({
                        title: "@lang('Êtes-vous sûr de vouloir supprimer cet événement ?')",
                        text: "@lang('Cette opération est irréversible.')",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "@lang('Annuler')",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "@lang('Oui, supprimer l\'événement')'",
                        closeOnConfirm: false
                    },
                    function () {
                        window.location.href = '{{ route('dashboard.events.index') }}/' + eid + '/delete';
                    });
            });
        });
    </script>
@endsection
