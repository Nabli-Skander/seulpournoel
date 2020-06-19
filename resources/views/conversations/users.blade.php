<div class="col-md-5 col-lg-5 col-xl-4">
    <!--============ Section Title===========================================================-->
    <div id="messaging__chat-list" class="messaging__box">

        <div class="messaging__content">
            <ul class="messaging__persons-list">
                @foreach($users as $userM)

                    <li>
                        <a href="{{route('conversations.show', $userM->id)}}"
                           class="messaging__person @if( isset($user)) @if($user->id == $userM->id) active @endif @endif">
                            <figure class="messaging__image-item" style="background-size: 100%;"
                                    data-background-image="{{$userM->imageURL()}}"></figure>
                            <figure class="content">
                                <h5>{{$userM->first_name}}</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut</p>
                                <small>24 Hour Ago</small>
                            </figure>
                            @if(isset($unread[$userM->id]))
                                <figure class="messaging__image-person">{{$unread[$userM->id]}}</figure>
                            @endif
                        </a>
                        <!--messaging__person-->
                    </li>

                @endforeach

            </ul>
            <!--end messaging__persons-list-->
        </div>
        <!--messaging__content-->
    </div>
    <!--end section-title-->
</div>