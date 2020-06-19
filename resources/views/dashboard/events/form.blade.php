<section>
    <h2>@lang('Informations générales')</h2>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="title" class="col-form-label required">@lang('Titre')</label>
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Donnez un titre à votre événement')]) !!}
            </div>
            <!--end form-group-->
        </div>
        <!--end col-md-8-->
        <div class="col-md-5">
            <div class="form-group">
                <label for="price" class="col-form-label required">@lang('Participation souhaitée (€)')</label>
                {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => __('Montant de la participation souhaitée')]) !!}
            </div>
            <!--end form-group-->
        </div>
    </div>
</section>

<section>
    <h2>@lang('Date')</h2>
    <div class="row">
        <div class="col-md-3">
            <label for="day" class="col-form-label required">@lang('Jour')</label>
            {!! Form::selectRange('day', 1, 31, 24) !!}

        </div>
        <div class="col-md-3">
            <label for="month" class="col-form-label required">@lang('Mois')</label>
            {!! Form::selectMonth('month', 12) !!}


        </div>
        <div class="col-md-3">

            <label for="year" class="col-form-label required">@lang('Année')</label>
            {!! Form::selectRange('year', date("Y"), date("Y") + 5, date("Y")) !!}


        </div>
        <div class="col-md-3">

            <label for="time" class="col-form-label required">@lang('Heure')</label>

            @php
                $time = [];
                for ($i = 0; $i < 30 * 24 * 4; $i+=30) {
                    $t = \Carbon\Carbon::createFromTime(0, 0, 0)->addMinutes($i);
                    $time[$t->format('H:i')] = $t->format('H \h i');
                }
            @endphp
            {!! Form::select('time', $time, '19:00') !!}

        </div>
    </div>
</section>

<section>
    <h2>@lang('Localisation')</h2>

    <!--end row-->
    <div class="form-group">
        <label for="input-location" class="col-form-label">@lang('Lieu exact')</label>
        <p>@lang('Veuillez indiquer le lieu exact (incluant la rue, la ville et le pays si nécessaire) puis cliquez sur la suggestion.')</p>
        {!! Form::text('location', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'input-location']) !!}

        <span class="geo-location input-group-addon" data-toggle="tooltip" data-placement="top" title=""
              data-original-title="Find My Position"><i class="fa fa-map-marker"></i></span>


    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="address" class="col-form-label">@lang('Adresse')</label>
                {!! Form::text('address', null, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'address']) !!}
            </div>
            <!--end form-group-->
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="postal_code" class="col-form-label">@lang('Code postal')</label>
                {!! Form::text('postal_code', null, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'postal_code']) !!}
            </div>
            <!--end form-group-->
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="city" class="col-form-label">@lang('Ville')</label>
                {!! Form::text('city', null, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'city']) !!}
            </div>
            <!--end form-group-->
        </div>
        <!--end col-md-6-->
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="state" class="col-form-label">@lang('État / Région')</label>
                {!! Form::text('state', null, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'state']) !!}
            </div>
            <!--end form-group-->
        </div>
        <!--end col-md-6-->
        <div class="col-md-6">
            <div class="form-group">
                <label for="country" class="col-form-label">@lang('Pays')</label>
                {!! Form::text('country', null, ['class' => 'form-control', 'readonly' => 'readonly', 'id' => 'country']) !!}
            </div>
            <!--end form-group-->
        </div>
        <!--end col-md-6-->
    </div>

    <!--end form-group-->
    <label>Map</label>
    <div class="map height-400px" id="map-submit" style="position: relative; overflow: hidden;">
    </div>
    {!! Form::hidden('longitude', null, ['id'=> 'longitude']) !!}
    {!! Form::hidden('latitude', null, ['id'=> 'latitude']) !!}
</section>

<section>
    <h2>Details</h2>
    <div class="form-group">
        <label for="details" class="col-form-label">@lang('Description')</label>
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    <!--end form-group-->
</section>


<section>
    <h2>Photo</h2>
    <div class="file-upload">
        <input type="file" name="image" id="image" class="file-upload-input" title="Click to add files">
        <span><i class="fa fa-plus-circle"></i>@lang('Télécharger une image')</span>
    </div>
    <div class="text-center">
        @if(isset($event) && $event->imageURL(null))
            <img id="preview" height="150" src="{{$event->imageURL()}}"/>
        @else
            <img id="preview" height="150"/>
        @endif
    </div>


</section>

@if(!isset($event))
    <section>
        <h2>@lang('Inviter des utilisateurs')</h2>
        <div class="row">
            <div class="col-md-12">
                <label>@lang('Inviter tous les utilisateurs du site dans un rayon de :')</label>
                <div class="alert alert-primary">@lang('Vous pouvez inviter ou relancer les utilisateurs au maximum') {{ \App\Event::$boostMax }}
                    @lang('fois.')<br>
                    @if(isset($event))
                        @lang('Invitations restantes :') {{ $event->boostRemaining() }}
                    @endif
                </div>
                <figure>
                    <label class="framed">
                        {{ Form::radio('boost', '30') }} 30 km
                    </label>
                    <label class="framed">
                        {{ Form::radio('boost', '60') }}60 km
                    </label>
                    <label class="framed">
                        {{ Form::radio('boost', '120') }}120 km
                    </label>
                    <label class="framed">
                        {{ Form::radio('boost', '0') }} @lang('Ne pas inviter les autres utilisateurs')
                    </label>
                </figure>

            </div>

        </div>
    </section>
@endif
<br>
<br>
<section>
    @if(isset($legal) && $legal)
        {{ Form::checkbox('accept-terms', 0, null,['class'=>'legal accept-terms']) }} @lang('J\'ai lu et j’accepte les')
        <a href="{{ route('terms') }}">
            @lang('Conditions Générales d\'Utilisation')
        </a>  @lang('du site').<br>
        {{--{{ Form::checkbox('accept-checkout',0, null, ['class'=>'legal accept-checkout']) }} Je comprends et--}}
        {{--j’accepte de--}}
        {{--m’acquitter de--}}
        {{--2--}}
        {{--€--}}
        {{--pour--}}
        {{--créer mon événement--}}
    @endif
</section>
<br>
<section class="clearfix">
    <div class="form-group">
        {{--<button type="submit" class="btn btn-primary large icon float-right">Preview<i--}}
        {{--class="fa fa-chevron-right"></i></button>--}}
        {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary large icon float-right', 'id' => 'submit_btn']) !!}
        @if(isset($legal) && $legal)
            <div id="submit_alert">
                <div class="alert alert-danger">@lang('Vous devez cocher la case précédente afin de pouvoir créer l\'événement.')
                </div>
                <br>
                <a class="btn btn-primary large icon float-right disabled">@lang('Créer l\'événement')</a>

            </div>
        @endif
    </div>
</section>

@if(isset($event) && $event->boostRemaining()  > 0)
    <hr>
    <section>
        <h2>@lang('Inviter des utilisateurs')</h2>
        <div class="row">
            <div class="col-md-12">
                <label>@lang('Inviter tous les utilisateurs du site dans un rayon de :')</label>
                <div class="alert alert-primary">@lang('Vous pouvez inviter ou relancer les utilisateurs au
maximum') {{ \App\Event::$boostMax }} @lang('fois').<br>
                    @if(isset($event))
                        @lang('Invitations restantes :') {{ $event->boostRemaining() }}
                    @endif
                </div>
                <figure>
                    <label class="framed">
                        {{ Form::radio('boost', '30') }} 30 km
                    </label>
                    <label class="framed">
                        {{ Form::radio('boost', '60') }} 60 km
                    </label>
                    <label class="framed">
                        @if(isset($event))
                            {{ Form::radio('boost', '120', true,['checked' => 'checked']) }}
                        @else
                            {{ Form::radio('boost', '120') }}
                        @endif
                        120 km
                    </label>{!! Form::submit('Inviter', ['class' => 'btn btn-primary icon ', 'id' => 'submit', 'name' => 'submit_invit']) !!}
                </figure>

            </div>

        </div>
    </section>

@endif


@section('scripts')
    @parent

    <script>
        @if(isset($legal) && $legal)
        $('#submit_btn').hide();
        $('#submit_alert').show();
        $('.legal').on('ifToggled', function () {
            if ($('.accept-terms').prop('checked')) {
                $('#submit_btn').show();
                $('#submit_alert').hide();
            } else {
                $('#submit_btn').hide();
                $('#submit_alert').show();
            }
        });

        @endif

        $(document).ready(function () {
            document.getElementById("image").onchange = function () {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // get loaded data and render thumbnail.
                    document.getElementById("preview").src = e.target.result;
                };

                reader.readAsDataURL(this.files[0]);
            };
        })

    </script>

@endsection