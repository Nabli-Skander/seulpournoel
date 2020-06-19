@extends('layouts.default')

@section('title', '')
@section('head')
    <style>
        .soon {
            display: block;
            text-align: center;
            line-height: 50px;
            font-size: 30px;
        }

        .soon-2 {
            color: #54BC4A;
        }

        body {
            height: 100%;
            position: relative;
        }

        .soon-wrapper {
            padding: 60px 0;
        }

        body .footer {
            position: absolute;
            bottom: 0;
        }

    </style>
@endsection
@section('content')

    <div class="soon-wrapper">
        <span class="soon soon-1">Rendez-vous</span>
        <span class="soon soon-2">lundi 15 novembre 2018</span>
        <span class="soon soon-3">pour commencer à organiser vos festivités</span>

    </div>
@endsection






