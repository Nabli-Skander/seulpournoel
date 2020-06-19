@extends('layouts.default')

@section('title', __('Réinitialiser le mot de passe'))



@section('content')
    <section class="block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">

                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-form-label required">@lang('Adresse e-mail')</label>


                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ $email or old('email') }}" required autofocus>

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

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm"
                                   class="col-form-label required">@lang('Confirmez le mot de passe')</label>

                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-baseline">
                            <button type="submit" class="btn btn-primary">
                                @lang('Réinitialiser le mot de passe')
                            </button>
                        </div>


                    </form>
                </div>
                <!--end col-md-6-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
@endsection


