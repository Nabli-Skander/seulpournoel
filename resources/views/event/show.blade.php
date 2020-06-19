@extends('layouts.default')
@section('title')
    {{ $event->title }}
@endsection


@section('content')
    <section class="block">
        <div class="container">

            <div class="row flex-column-reverse flex-md-row">
                <!--============ Listing Detail =============================================================-->
                <div class="col-md-8">
                    <!--Description-->
                    <section>
                        <h2>@lang('Description')</h2>
                        <p>{{ $event->description }}
                        </p>
                    </section>


                    <section>
                        <div class="row">
                            <div class="col-md-4">
                                <h2>@lang('Détails')</h2>
                                <dl>
                                    <dt>@lang('Prix')</dt>
                                    <dd>{{ $event->price() }}</dd>

                                    <dt>@lang('Date')</dt>
                                    <dd>{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y')}}</dd>

                                    <dt>@lang('Heure')</dt>
                                    <dd>{{ \Carbon\Carbon::parse($event->date)->format('H:i')}}</dd>

                                    <dt>@lang('Lieu')</dt>
                                    <dd>{{ $event->city }}, {{ $event->postal_code }}</dd>

                                    <dt>@lang('Publié')</dt>
                                    <dd>{{ \Carbon\Carbon::parse($event->created_at)->format('d-m-Y - H:i')}}</dd>

                                </dl>
                            </div>
                            <div class="col-md-8">
                                <h2>@lang('Localisation')</h2>
                                <div class="map height-300px" id="map-small"></div>
                            </div>
                        </div>
                    </section>

                    <section>
                        {{--@foreach(->get() as $user)--}}
                        {{--{{$event->participe()}}--}}
                        {{--@endforeach--}}
                    </section>
                    <section>
                        @if(($event->mine() || $event->registered())&& $event->participant())

                            <div class="box">
                                <div id="messaging__chat-window" class="messaging__box">

                                    <div class="messaging__content" data-background-color="rgba(0,0,0,.05)">
                                        <div class="messaging__main-chat">
                                            <div class="messaging__main-chat__bubble row">
                                                <div class="author">
                                                    <div class="author-image">
                                                        <div class="background-image">
                                                            <img src="{{$event->host->imageURL() }}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p>
                                                    Curabitur vel venenatis sem. Fusce suscipit pharetra nisl, sit amet
                                                    blandit sem sollicitudin ac.
                                                    <small>24 hour ago</small>
                                                </p>
                                            </div>
                                            <div class="messaging__main-chat__bubble user row">
                                                <p>
                                                    Sed dignissim lacus risus, ut blandit nunc
                                                    <small>24 hour ago</small>
                                                </p>
                                                <div class="author">
                                                    <div class="author-image">
                                                        <div class="background-image">
                                                            <img src="{{$event->host->imageURL() }}" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="messaging__footer">
                                        <form class="form">
                                            <div class="input-group">
                                                <input type="text" class="form-control mr-4"
                                                       placeholder="Votre Message">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"><i
                                                                class="fa fa-send"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </section>
                {{--@if($event->canRequest())--}}
                {{--<br>--}}

                {{--<div class="box">--}}
                {{--<!--end author-->--}}

                {{--{!! Form::open(array('route' => ['events.participate', $event->id], 'class' => 'form')) !!}--}}
                {{--<!--end form-group-->--}}
                {{--<div class="form-group">--}}

                {{--<textarea name="message" id="message" class="form-control" rows="4"--}}
                {{--placeholder="@lang('Personalisez votre demande !')"></textarea>--}}
                {{--</div>--}}
                {{--<!--end form-group-->--}}


                {{--<button type="submit"--}}
                {{--class="btn btn-primary">@lang('Je souhaite participer')</button>--}}


                {{--{!! Form::close() !!}--}}


                {{--</div>--}}
                {{--@endif--}}
                {{--<h2>@lang('Participants')</h2>--}}

                {{--@if($event->registered())--}}
                {{--<div class="alert alert-success">--}}
                {{--@lang('Je participe') :--}}

                {{--<br>--}}
                {{--<br>--}}
                {{--<ul>--}}
                {{--<li>--}}
                {{--<strong>@lang('Date :')</strong> {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y')}}--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<strong>@lang('Heure :')</strong> {{ \Carbon\Carbon::parse($event->date)->format('H:i')}}--}}
                {{--</li>--}}
                {{--<li><strong>@lang('Lieu :')</strong> {{ $event->location }}</li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--@endif--}}

                {{--<div class="authors items grid-xl-4-items grid-lg-4-items grid-md-4-items list"--}}
                {{--style="position: relative; height: 2160px;">--}}
                {{--@foreach($event->users()->orderBy('events_users.id', 'desc')->get() as $user)--}}


                {{--@if ((\Auth::user() && $user->id == \Auth::user()->id) || $event->mine() || $user->pivot->status == 'accepted')--}}
                {{--<div class="item author" style="position: absolute; left: 0px; top: 0px;">--}}
                {{--<div class="wrapper">--}}
                {{--<div class="image">--}}
                {{--<h3>--}}
                {{--<a href="{{ route('profile.show', $user->id) }}"--}}
                {{--class="title">{{$user->first_name}}</a>--}}


                {{--</h3>--}}
                {{--<a href="{{ route('profile.show', $user->id) }}"--}}
                {{--class="image-wrapper background-image"--}}
                {{--style="background-image: url(&quot;/theme/img/author-02.jpg&quot;);">--}}
                {{--<img src="{{$user->imageURL() }}" alt="">--}}
                {{--</a>--}}
                {{--</div>--}}
                {{--<!--end image-->--}}
                {{--<h4 class="location">--}}
                {{--<a href="#">{{$user->location()}}</a>--}}
                {{--</h4>--}}
                {{--@if ($event->mine() || (\Auth::user() && $user->id == \Auth::user()->id))--}}
                {{--<div class="meta">--}}
                {{--@if ($user->pivot->status == 'new')--}}
                {{--@if($event->mine())--}}
                {{--<a href="{{ route('events.requestaction', [$event->id, $user->pivot->id, 'decline']) }}"--}}
                {{--class="btn btn-danger btn-framed small">@lang('Refuser')</a>--}}
                {{--<a href="{{ route('events.requestaction', [$event->id, $user->pivot->id, 'accept']) }}"--}}
                {{--class="btn btn-success small">@lang('Accepter')</a>--}}
                {{--@else--}}
                {{--<div class="alert alert-primary">@lang('Demande soumise')</div>--}}
                {{--@endif--}}
                {{--@elseif ($user->pivot->status == 'accepted')--}}
                {{--<div class="alert alert-success">@lang('Demande acceptée')</div>--}}
                {{--@elseif ($user->pivot->status == 'refused')--}}
                {{--<div class="alert alert-danger">@lang('Demande refusée')</div>--}}
                {{--@endif--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--<!--end meta-->--}}
                {{--@if($event->mine() || (\Auth::user() && $user->id == \Auth::user()->id) )--}}
                {{--<div class="description">--}}
                {{--<p>{{ $user->pivot->message }}</p>--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--<!--end description-->--}}
                {{--@if ($event->mine())--}}
                {{--<div class="additional-info">--}}
                {{--<ul>--}}
                {{--<li>--}}
                {{--<figure>@lang('Message')</figure>--}}
                {{--<aside>{{ $user->pivot->message }}</aside>--}}
                {{--</li>--}}

                {{--</ul>--}}
                {{--</div>--}}
                {{--@endif--}}
                {{--</div>--}}
                {{--</div>--}}

                {{--@endif--}}
                {{--@endforeach--}}


                {{--</div>--}}
                {{--</section>--}}


                <!--end Similar Ads-->
                </div>
                <!--============ End Listing Detail =========================================================-->
                <!--============ Sidebar ====================================================================-->
                <div class="col-md-4">
                    <aside class="sidebar">
                        @if($event->imageURL(null))
                            <img src="{{ $event->imageURL() }}" width="100%"/>
                            <br/>
                            <br/>
                    @endif
                    <!--Author-->
                        <section>
                            <h2>@lang('Hôte')</h2>
                            <div class="box">
                                <div class="author">
                                    <div class="author-image">
                                        <div class="background-image">
                                            <img src="{{$event->host->imageURL() }}" alt="">
                                        </div>
                                    </div>
                                    <!--end author-image-->
                                    <div class="author-description">
                                        <h3>{{ $event->host->first_name }}</h3>
                                        <a href="{{ route('profile.show', $event->host->id) }}" class="text-uppercase">
                                            @lang('Voir le profil')
                                        </a>
                                    </div>
                                    <!--end author-description-->
                                </div>
                                @if($event->mine() || $event->registered())
                                    <hr>
                                    <dl>
                                        <dt>@lang('Téléphone')</dt>
                                        <dd>{{ $event->host->phone }}</dd>
                                        <dt>@lang('E-mail')</dt>
                                        <dd>{{ $event->host->email }}</dd>
                                    </dl>
                                @endif

                                <div class="items compact" style="position: relative;">
                                    <hr>
                                    @if($event->registered())
                                        <div class="alert alert-success">
                                            @lang('Je participe') :

                                            <br>
                                            <br>
                                            <ul>
                                                <li>
                                                    <strong>@lang('Date :')</strong> {{ \Carbon\Carbon::parse($event->date)->format('d-m-Y')}}
                                                </li>
                                                <li>
                                                    <strong>@lang('Heure :')</strong> {{ \Carbon\Carbon::parse($event->date)->format('H:i')}}
                                                </li>
                                                <li><strong>@lang('Lieu :')</strong> {{ $event->location }}</li>
                                            </ul>
                                        </div>
                                    @endif

                                    @if(  $event->participant()  )
                                        <h3 style="text-align: center; margin-top: 4rem">Participant(s)</h3>
                                    @endif()


                                    @foreach($event->users()->orderBy('events_users.id', 'desc')->get() as $user)

                                        @if ((\Auth::user() && $user->id == \Auth::user()->id) || $event->mine() || $user->pivot->status == 'accepted')
                                            <div class="item" style="{{--position: absolute; left: 0px;--}} top: 18px;">
                                                <div class="wrapper">
                                                    <div class="image">
                                                        <h3>
                                                            <a href="{{ route('profile.show', $user->id) }}"
                                                               class="title">{{$user->first_name}}</a>


                                                        </h3>
                                                        <a href="{{ route('profile.show', $user->id) }}"
                                                           class="image-wrapper background-image"
                                                           style="background-image: url({{$user->imageURL() }});">
                                                            <img src="{{$user->imageURL() }}" alt="">
                                                        </a>
                                                    </div>
                                                    <!--end image-->
                                                    <h4 class="location">
                                                        <a href="#">{{$user->location()}}</a>
                                                    </h4>

                                                    @if($event->mine() || $event->registered() )
                                                        <div class="description">
                                                            <p>{{ $user->pivot->message }}</p>
                                                        </div>
                                                    @endif
                                                <!--end description-->
                                                    @if ($event->mine() || (\Auth::user() && $user->id == \Auth::user()->id))
                                                        <div class="meta">
                                                            @if ($user->pivot->status == 'new')
                                                                @if($event->mine())
                                                                    <a href="{{ route('events.requestaction', [$event->id, $user->pivot->id, 'decline']) }}"
                                                                       class="btn btn-danger btn-framed small">@lang('Refuser')</a>
                                                                    <a href="{{ route('events.requestaction', [$event->id, $user->pivot->id, 'accept']) }}"
                                                                       class="btn btn-success small">@lang('Accepter')</a>
                                                                @else
                                                                    <div class="alert alert-primary">@lang('Demande soumise')</div>
                                                                @endif
                                                            @elseif ($user->pivot->status == 'accepted')
                                                                <div class="alert alert-success">@lang('Demande acceptée')</div>
                                                            @elseif ($user->pivot->status == 'refused')
                                                                <div class="alert alert-danger">@lang('Demande refusée')</div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                <!--end meta-->


                                                    {{--@if ($event->mine())--}}
                                                    {{--<div class="additional-info">--}}
                                                    {{--<ul>--}}
                                                    {{--<li>--}}
                                                    {{--<figure>@lang('Message')</figure>--}}
                                                    {{--<aside>{{ $user->pivot->message }}</aside>--}}
                                                    {{--</li>--}}

                                                    {{--</ul>--}}
                                                    {{--</div>--}}
                                                    {{--@endif--}}


                                                </div>
                                            </div>

                                        @endif

                                    @endforeach


                                </div>
                            </div>


                            <!--end box-->
                        </section>
                        <!--End Author-->
                    </aside>
                </div>
                <!--============ End Sidebar ================================================================-->
            </div>
        </div>
        <!--end container-->
    </section>
    <!--end block-->

@endsection


@section('scripts')
    <script>
        let latitude = {{ $event->latitude }};
        let longitude = {{ $event->longitude }};
        let markerImage = "/img/marker.png";
        let mapTheme = "light";
        let mapElement = "map-small";
        simpleMap(latitude, longitude, markerImage, mapTheme, mapElement);
    </script>
@endsection