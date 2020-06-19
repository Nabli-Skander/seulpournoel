@extends('layouts.default')

@section('title', __('Connexion'))

@section('content')
    <section class="block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form class="form clearfix" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-form-label required">@lang('E-mail')</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <!--end form-group-->
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-form-label required">@lang('Mot de passe')</label>
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <!--end form-group-->
                        <div class="d-flex justify-content-between align-items-baseline">
                            <label class="">
                                <div class="icheckbox">
                                    <input type="checkbox" name="remember"
                                           {{ old('remember') ? 'checked' : '' }} style="position: absolute; opacity: 0;">
                                    <ins class="iCheck-helper"
                                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                </div>
                                @lang('Resté connecté')
                            </label>
                            <button type="submit" class="btn btn-primary">@lang('Connexion')</button>
                        </div>
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






