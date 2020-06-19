@extends('layouts.default')

@section('title', __('Réinitialiser le mot de passe'))

@section('content')
    <section class="block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-form-label required">@lang('Adresse e-mail')</label>

                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="d-flex justify-content-between align-items-baseline">
                                <button type="submit" class="btn btn-primary">
                                    @lang('Envoyer la demande de réinitialisation du mot de passe')
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