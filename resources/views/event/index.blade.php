@extends('layouts.default')
@section('title')
    @if (strlen(\Request::get('location')))

        @lang('Evénements à proximité de') {{ \Request::get('location') }}

    @else
        @lang('Evénements')
    @endif
@endsection


@section('content')
    <section class="block">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-9">
                    @if(count($events) > 0)
                        <div class="section-title clearfix">

                            <div class="float-right float-xs-none d-xs-none thumbnail-toggle">
                                <a href="#" class="change-class" data-change-from-class="list"
                                   data-change-to-class="grid"
                                   data-parent-class="items">
                                    <i class="fa fa-th"></i>
                                </a>
                                <a href="#" class="change-class active" data-change-from-class="grid"
                                   data-change-to-class="list" data-parent-class="items">
                                    <i class="fa fa-th-list"></i>
                                </a>
                            </div>

                        </div>  @endif
                <!--============ Items ==========================================================================-->
                    <div class="items list grid-xl-3-items grid-lg-3-items grid-md-2-items">
                        @if(count($events) == 0)
                            <div class="alert alert-info" role="alert">
                                @lang('Il n\'y a aucun événement pour le moment.')
                            </div>
                        @else
                            @foreach ($events as $event)
                                <div class="item">
                                    <!--end ribbon-->
                                    <div class="wrapper">
                                        <div class="image">
                                            <h3>
                                                <a href="{{ route('events.show', $event->id) }}"
                                                   class="title">{{ $event->title }}</a>
                                            </h3>
                                            <a href="{{ route('events.show', $event->id) }}"
                                               class="image-wrapper background-image"
                                               style="background-image: url('{{$event->imageURL()}}');">
                                                <img src="{{$event->imageURL()}}" alt="">
                                            </a>
                                        </div>
                                        <!--end image-->
                                        <h4 class="location">
                                            <a href="{{route('events.index')}}?location={{ $event->locationShort() }}">{{ $event->locationShort() }}</a>
                                        </h4>
                                        <div class="price">{{ $event->price() }}</div>
                                        <div class="meta">
                                            <figure>
                                                <i class="fa fa-calendar-o"></i>{{ Carbon\Carbon::parse($event->date)->format('d-m-Y - H:i') }}
                                            </figure>
                                            <figure>
                                                <a href="#">
                                                    <i class="fa fa-user"></i>{{ $event->host->first_name }}
                                                </a>
                                            </figure>
                                        </div>
                                        <!--end meta-->
                                        <div class="description">
                                            <p>{{ $event->shortDescription() }}</p>
                                        </div>
                                        <!--end description-->
                                        <a href="{{ route('events.show', $event->id) }}"
                                           class="detail text-caps underline">@lang('Plus d\'infos')</a>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        @endif

                    </div>
                    <!--============ End Items ==============================================================-->
                    {{ $events->links() }}
                </div>
                <!--end col-md-9-->
                <div class="col-md-3">
                    <!--============ Side Bar ===============================================================-->
                    <aside class="sidebar">
                        <section>
                            <h2>Search Ads</h2>
                            <!--============ Side Bar Search Form ===========================================-->
                        {!! Form::open(['route' => 'events.index', 'method' => 'get', 'class' => 'sidebar-form form']) !!}

                        <!--end form-group-->
                            <div class="form-group">
                                <label for="input-location" class="col-form-label"@lang('Où')</label>
                                <input name="location" type="text" class="form-control" id="input-location"
                                       placeholder="Enter Location" autocomplete="off">
                                <span class="geo-location input-group-addon" data-toggle="tooltip"
                                      data-placement="top"
                                      title="" data-original-title="Find My Position"><i
                                            class="fa fa-map-marker"></i></span>
                            </div>
                            <!--end form-group-->

                            <!--end form-group-->
                            <button type="submit" class="btn btn-primary width-100">@lang('Rechercher')</button>
                        {!! Form::close() !!}
                        <!--============ End Side Bar Search Form =======================================-->
                        </section>
                    </aside>
                    <!--============ End Side Bar ===========================================================-->
                </div>
                <!--end col-md-3-->
            </div>
        </div>


    </section>

@endsection









