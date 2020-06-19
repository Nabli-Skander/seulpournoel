@extends('layouts.dashboard')

@section('title', __('Changer mon mot de passe'))

@section('dashboard-content')
    {!! Form::open(['action' => 'PasswordController@update', 'method' => 'patch']) !!}


    <section>
        <div class="form-group has-error">
            <label for="password_old" class="col-form-label required">@lang('Ancien mot de passe')</label>
            {!! Form::password('password_old', null, ['class' => 'form-control']) !!}

        </div>
        <!--end form-group-->
        <div class="form-group">
            <label for="password_new" class="col-form-label required">@lang('Nouveau mot de passe')</label>
            {!! Form::password('password_new', null, ['class' => 'form-control']) !!}

        </div>

        <div class="form-group">
            <label for="password_new_confirmation"
                   class="col-form-label required">@lang('Confirmez le nouveau mot de passe')</label>
            {!! Form::password('password_new_confirmation', null, ['class' => 'form-control']) !!}

        </div>
    </section>

    <section class="clearfix">
        <button type="submit" class="btn btn-primary float-right">@lang('Enregistrer les changements')</button>
    </section>

    {!! Form::close() !!}

@endsection

