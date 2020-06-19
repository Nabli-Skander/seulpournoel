@extends('layouts.default')


@section('title', __('Inscription'))



@section('content')


    <section class="block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">

                    <p>
                        @lang('Déjà inscrit ?')
                        <a class="link" href="{{ route('login') }}">
                            @lang('Connectez-vous ici')
                        </a>

                    </p>
                    <hr>

                    <form class="form clearfix" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-form-label required">@lang('Prénom')</label>

                            <input id="first_name" type="text" class="form-control" name="first_name"
                                   value="{{ old('first_name') }}"
                                   required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="help-block">
<strong>{{ $errors->first('first_name') }}</strong>
</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-form-label required">@lang('Nom')</label>

                            <input id="last_name" type="text" class="form-control" name="last_name"
                                   value="{{ old('last_name') }}"
                                   required autofocus>

                            @if ($errors->has('last_name'))
                                <span class="help-block">
<strong>{{ $errors->first('last_name') }}</strong>
</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="location" class="col-form-label required">@lang('Ville, Pays')</label>

                            <input id="location" type="text" class="form-control" name="location"
                                   value="{{ old('location') }}"
                                   required autofocus>

                            @if ($errors->has('location'))
                                <span class="help-block">
<strong>{{ $errors->first('location') }}</strong>
</span>
                            @endif
                        </div>


                            <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-form-label required">@lang('Sexe')</label>
                                <figure>
                                    <label class="framed">
                                        {{ Form::radio('sex', 'm') }} @lang('Homme')
                                    </label>
                                    <label class="framed">
                                        {{ Form::radio('sex', 'f') }} @lang('Femme')
                                    </label>

                                </figure>
                            </div>

                        <span class="help-block">
<strong>{{ $errors->first('sex') }}</strong>
</span>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-form-label required">@lang('E-mail')</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required>

                            @if ($errors->has('email'))
                                <span class="help-block">
<strong>{{ $errors->first('email') }}</strong>
</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-form-label required">@lang('Mot de passe')</label>

                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
<strong>{{ $errors->first('password') }}</strong>
</span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-baseline">

                            <button type="submit" class="btn btn-primary">
                                @lang('Inscription')
                            </button>
                        </div>

                        {!! Form::hidden('lng') !!}
                        {!! Form::hidden('lat') !!}
                        {!! Form::hidden('city') !!}
                        {!! Form::hidden('state') !!}
                        {!! Form::hidden('country') !!}
                    </form>


                    <hr>
                    <p>
                        @lang('Mot de passe oublié ?')
                        <a class="link" href="{{ route('password.request') }}">
                            @lang('Cliquez ici')
                        </a>

                    </p>
                </div>
                <!--end col-md-6-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
@endsection

@section('scripts')
    <script>

        function initialize() {
            var options = {
                types: ['(cities)']
            };
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input, options);

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();

                for (var i = 0; i < place.address_components.length; i++) {
                    var component = place.address_components[i];
                    if (component.types[0] === 'locality') {
                        $('[name="city"]').val(component.long_name);
                    }
                    if (component.types[0] === 'country') {
                        $('[name="country"]').val(component.long_name);
                    }
                    if (component.types[0] === 'administrative_area_level_1') {
                        $('[name="state"]').val(component.long_name);
                    }
                }

                $('[name="lng"]').val(place.geometry.location.lng());
                $('[name="lat"]').val(place.geometry.location.lat());
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
@endsection




