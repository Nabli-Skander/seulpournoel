@extends('layouts.dashboard')

@section('title', 'Mes évenements')

@section('dashboard-content')
    {!! Form::open(['action' => 'DashboardEventController@store', 'enctype'=>'multipart/form-data']) !!}
    @include('dashboard.events.form', ['submitButtonText' => __('Créer l\'événement'), 'legal' => true])
    <div class="hidden">
        @if(env('STRIPE_ENABLED') != false)
            <script
                    src="https://checkout.stripe.com/checkout.js"
                    class="stripe-button hidden"
                    data-key="{{env('STRIPE_KEY')}}"
                    data-name="Seul Pour Noël"
                    data-billing-address=true
                    data-shipping-address=true
                    data-label=""
                    data-description="Créer un événement"
                    data-currency="eur"
                    data-locale="{{ LaravelLocalization::getCurrentLocale() }}"
                    data-amount="200">
            </script>
        @endif
    </div>     @if(env('STRIPE_ENABLED') != false)
        <div class="alert alert-info">Afin de nous assurer du sérieux des hôtes, nous demandons des frais de création de
            2
            euros. En cliquant sur le bouton ci-dessus, vous serez redirigé vers le formulaire de paiement.
        </div>
    @endif
    {!! Form::close() !!}

@endsection

@section('scripts')

    @parent

    <script>

        var latitude = 51.511971;
        var longitude = -0.137597;
        var markerImage = "/img/marker.png";
        var mapTheme = "light";
        var mapElement = "map-submit";
        var markerDrag = true;
        simpleMap(latitude, longitude, markerImage, mapTheme, mapElement, markerDrag);

    </script>
@endsection