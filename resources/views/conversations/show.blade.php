@extends('layouts.default')

@section('content')

    <section class="content">
        <section class="block">
            <div class="container">
                <div class="row">
                @include('conversations.users', ['users' => $users, 'unread' => $unread])
                <!--end col-md-3-->
                    <div class="col-md-7 col-lg-7 col-xl-8">
                        <!--============ Section Title===========================================================-->

                        <!--end section-title-->
                        <div id="messaging__chat-window" class="messaging__box">
                            {{--<div class="messaging__header">--}}
                            {{--<div class="float-left flex-row-reverse messaging__person">--}}
                            {{--<h5 class="font-weight-bold">Rosina Warner</h5>--}}
                            {{--<figure class="mr-4 messaging__image-person" data-background-image="assets/img/author-02.jpg"></figure>--}}
                            {{--</div>--}}
                            {{--<div class="float-right messaging__person">--}}
                            {{--<h5 class="mr-4">You</h5>--}}
                            {{--<figure id="messaging__user" class="messaging__image-person" data-background-image="assets/img/author-06.jpg"></figure>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div id="scrollBot" class="messaging__content" data-background-color="rgba(0,0,0,.05)">
                                <div class="messaging__main-chat">
                                    @if($messages->hasMorePages())
                                        <div class="text-center">
                                            <a href="{{ $messages->nextPageUrl() }}" class="btn btn-light">previeus</a>
                                        </div>
                                    @endif
                                    @foreach(array_reverse($messages->items()) as $message)
                                        {{----------------------------------------------------------------------------}}

                                        <div class="messaging__main-chat__bubble row @if( \Auth::user()->id === $message->from_id )user @endif ">
                                            @if( \Auth::user()->id === $message->from_id )
                                                <p>
                                                    {{ $message->content  }}
                                                    <small>24 hour ago</small>
                                                </p>
                                            @endif
                                            <div class="author">
                                                <div class="author-image">
                                                    <div class="background-image">
                                                        {{--{{  $user->imageURL() }}--}}
                                                        <img src="{{ \Auth::user()->id === $message->from_id ? \Auth::user()->imageURL() : $user->imageURL() }} "
                                                             alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            @if( \Auth::user()->id === $message->to_id )
                                                <p>
                                                    {!! nl2br(e($message->content)) !!}
                                                    <small>24 hour ago</small>
                                                </p>
                                            @endif
                                        </div>


                                        {{----------------------------------------------------------------------------}}
                                    @endforeach
                                </div>
                                {{--<div class="messaging__main-chat author">--}}
                                {{--<div class="author-image">--}}
                                {{--<div class="background-image">--}}
                                {{--<img src="/uploads/users/5a2f434e64140.JPG" alt="">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="messaging__main-chat__bubble">--}}
                                {{--<p>--}}
                                {{--Curabitur vel venenatis sem. Fusce suscipit pharetra nisl, sit amet--}}
                                {{--blandit--}}
                                {{--sem sollicitudin ac.--}}
                                {{--<small class="float-right">24 hour ago</small>--}}
                                {{--</p>--}}
                                {{--</div>--}}
                                {{--<div class="messaging__main-chat__bubble @if( isset($user)) @if($user->id == $userM->id) user @endif @endif">--}}
                                {{--<p>--}}
                                {{--Vivamus laoreet nisl a odio commodo varius. Donec arcu mauris, molestie a--}}
                                {{--euismod at,--}}
                                {{--mattis eu arcu. Cras volutpat, velit sit amet cursus molestie, ex ipsum--}}
                                {{--sagittis urna,--}}
                                {{--vitae auctor augue erat eget justo. Sed dignissim lacus risus, ut blandit--}}
                                {{--nunc volutpat--}}
                                {{--quis. Fusce porta semper nisi, quis lobortis nulla ultricies ac.--}}
                                {{--<small>24 hour ago</small>--}}
                                {{--</p>--}}
                                {{--</div>--}}

                            </div>
                        </div>
                        <div class="messaging__footer">
                            <form class="form" action="" method="post">
                                {{csrf_field()}}
                                <div class="input-group">
                                    <input name="content" type="text" class="form-control mr-4" autocomplete="off"
                                           placeholder="Message">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end col-md-9-->
            </div>
            <!--end row-->
            </div>
            <!--end container-->
        </section>
        <!--end block-->
    </section>

@endsection