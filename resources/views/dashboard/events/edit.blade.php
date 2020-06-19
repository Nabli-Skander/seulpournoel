@extends('layouts.dashboard')

@section('title', __('Mes événements'))

@section('dashboard-content')

    {!! Form::model($event, ['method' => 'PATCH', 'action' => ['DashboardEventController@update',$event->id], 'enctype'=>'multipart/form-data']) !!}
    @include('dashboard.events.form', ['submitButtonText' => __('Enregistrer les changements'), 'event' => $event])
    {!! Form::close() !!}

@endsection

@section('scripts')


    @parent

    <script>
        var latitude = {{ $event->latitude }};
        var longitude = {{ $event->longitude }};
        var markerImage = "/img/marker.png";
        var mapTheme = "light";
        var mapElement = "map-submit";
        var markerDrag = true;
        simpleMap(latitude, longitude, markerImage, mapTheme, mapElement, markerDrag);
    </script>

@endsection