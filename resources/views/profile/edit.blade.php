@extends('layouts.dashboard')

@section('title', __('Changer mon profil'))

@section('dashboard-content')
    {!! Form::model($user, ['method' => 'PATCH', 'action' => 'ProfileController@update', 'enctype'=>'multipart/form-data']) !!}




    <div class="row">
        <div class="col-md-8">
            <h2>@lang('Informations personnelles')</h2>


            <section>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" class="col-form-label required">@lang('Prénom')</label>


                            {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                        </div>
                        <!--end form-group-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name" class="col-form-label required">@lang('Nom')</label>
                            {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                        </div>
                        <!--end form-group-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name" class="col-form-label">@lang('Sexe')</label>
                            <figure>
                                <label class="framed">
                                    {{ Form::radio('sex', 'm') }} @lang('Homme')
                                </label>
                                <label class="framed">
                                    {{ Form::radio('sex', 'f') }} @lang('Femme')
                                </label>

                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="age" class="col-form-label">@lang('Age')</label>
                            {!! Form::number('age', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <!--end row-->
                <div class="form-group">
                    <label for="location" class="col-form-label">@lang('Localisation')</label>
                    {!! Form::text('location', null, ['class' => 'form-control', 'id' => 'location']) !!}
                </div>


                <!--end form-group-->
                <div class="form-group">
                    <label for="about" class="col-form-label">@lang('A propos de vous')</label>

                    {!! Form::textarea('about', null, ['class' => 'form-control', 'rows' => 5,
                    'placeholder' => __('Vos futurs hôtes sont curieux d’en savoir un peu plus sur vous. Ecrivez-leurs quelques lignes pour les aider à mieux vous connaître.')]) !!}

                </div>
                <!--end form-group-->
            </section>

            <section>
                <h2>@lang('Contact')</h2>

                <div class="form-group">
                    <label for="phone" class="col-form-label">@lang('Numéro de téléphone')</label>
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                </div>
                <!--end form-group-->
                <div class="form-group">
                    <label for="email" class="col-form-label">@lang('Adresse e-mail')</label>
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                </div>
                <!--end form-group-->
            </section>
            <div class="alert alert-info">@lang('Votre nom de famille ainsi que vos coordonnées ne sont rendues publique qu\'aux utilisateurs')
                :
                <ul>
                    <li>@lang('qui participent à vos énénements')</li>
                    <li>@lang('qui organisent un événement auquel vous participez')</li>
                </ul>
            </div>
            <br>
            <section class="clearfix">
                <a id="delete-profile" href="#" class="btn btn-secondary btn-framed">@lang('Supprimer mon profil')</a>
                <button type="submit" class="btn btn-primary float-right">@lang('Enregistrer')</button>
            </section>
        </div>
        <!--end col-md-8-->
        <div class="col-md-4">
            <div class="profile-image">
                <div class="image background-image">
                    <img src="{{$user->imageURL() }}" alt="">
                </div>
                <div class="single-file-input">
                    <input type="file" id="image" name="image">
                    <div class="btn btn-framed btn-primary small">@lang('Télécharger une image')</div>
                </div>
            </div>
        </div>
        <!--end col-md-3-->
    </div>

    {!! Form::hidden('lng') !!}
    {!! Form::hidden('lat') !!}
    {!! Form::hidden('city') !!}
    {!! Form::hidden('state') !!}
    {!! Form::hidden('country') !!}


    {!! Form::close() !!}

@endsection

@section('styles')
    <link rel="stylesheet" href="/vendor/sweetalert/sweetalert.css">
@endsection

@section('scripts')
    <script src="/vendor/sweetalert/sweetalert.min.js"></script>
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


        $(document).ready(function () {
            $('#delete-profile').click(function () {
                swal({
                        title: "Êtes-vous sûr de vouloir supprimer votre compte ?",
                        text: "Cette opération est irréversible.",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "Annuler",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Oui, supprimer mon compte",
                        closeOnConfirm: false
                    },
                    function () {
                        window.location.href = '{{ route('profile.delete') }}';
                    });
            });
        });
    </script>
@endsection