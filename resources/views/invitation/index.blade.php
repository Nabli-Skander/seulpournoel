@extends('layouts.dashboard')
@section('title')
    @lang('Mes invitations')
@endsection


@section('dashboard-content')


    <div class="items list  grid-xl-3-items grid-lg-2-items grid-md-2-items">
        @if (count($invitations) === 0)
            <div class="alert alert-info">
                @lang('Vous n\'avez aucune invitation pour le moment.')
            </div>
        @endif
        @foreach($invitations as $invitation)
            <div class="item">
                <div class="ribbon-featured">
                    <div class="ribbon-start"></div>
                    <div class="ribbon-content">@lang('de la part de') {{ $invitation->from->first_name }}</div>
                    <div class="ribbon-end">
                        <figure class="ribbon-shadow"></figure>
                    </div>
                </div>
                <div class="wrapper">
                    <div class="image">
                        <h3>
                            <a href="{{ route('events.show', $invitation->event->id) }}"
                               class="title">{{ $invitation->event->title }}</a>
                            <span class="tag">@lang('Invitation')</span>
                        </h3>
                        <a href="{{ route('events.show', $invitation->event->id) }}"
                           class="image-wrapper background-image"
                           style="background-image: url(&quot;assets/img/image-03.jpg&quot;);">
                            <img src="/theme/img/image-03.jpg" alt="">
                        </a>
                    </div>
                    <!--end image-->
                    <h4 class="location">
                        <a href="{{route('events.index')}}?location={{ $invitation->event->locationShort() }}">{{ $invitation->event->locationShort() }}</a>
                    </h4>
                    <div class="price">{{ $invitation->event->price() }}</div>
                    <!--end admin-controls-->
                    <div class="description">
                        <p>{{ $invitation->event->shortDescription() }}</p>
                    </div>
                    <!--end description-->
                    <a href="{{ route('events.show', $invitation->event->id) }}"
                       class="detail text-caps underline">@lang('Plus d\'infos')</a>
                </div>
            </div>
            <!--end item-->

        @endforeach



        @foreach([1] as $event)


        @endforeach
    </div>

@endsection









