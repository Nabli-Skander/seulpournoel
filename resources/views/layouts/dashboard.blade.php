@extends('layouts.default')

@section('content')
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('navigation.dashboard')
                </div>
                <div class="col-md-9">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </section>
@endsection
