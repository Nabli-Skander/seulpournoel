@extends('layouts.default')

@section('content')


        <div class="container">
            <section class="block">
                <div id="messagerie" data-base="{{route('conversations',[],false)}}">
                    <messagerie :user="{{ Auth::user()->id }}" ></messagerie>
                </div>
            </section>
            <!--end block-->
        </div>


    <script src="{{ mix('js/app.js') }}"></script>

@endsection