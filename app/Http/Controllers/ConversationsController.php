<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Notifications\MessageReceived;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;
use App\Repository\ConversationsRepository;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{

    private $r;

    public function __construct(ConversationsRepository $conversationsRepository)
    {
        $this->middleware('auth');
        $this->r = $conversationsRepository;

    }

    public function index()
    {


//        $users = $this->r->getConversations(Auth::user()->id);
//        $unread = $this->r->unreadCount(Auth::user()->id);
//
//        return view('conversations/index', compact('users', 'unread'));
        return view('conversations/index');

    }

    public function show(User $user)
    {

        if ($user === Auth::user()){
            return view('conversations/index');
        }

        $users = $this->r->getConversations(Auth::user()->id);
        $messages = $this->r->getMessagesFor(Auth::user()->id, $user->id)->paginate(5);
        $unread = $this->r->unreadCount(Auth::user()->id);

        if (isset($unread[$user->id])){
            $this->r->readAllFrom($user->id, Auth::user()->id );
            $unread[$user->id] = '';
        }


        return view('conversations.show', compact('users', 'user', 'messages','unread'));

    }

    public function store(User $user, StoreMessageRequest $request)
    {

//        if($user !== Auth::user()){

            $this->r->createMessage(
                $request->get('content'),
                Auth::user()->id,
                $user->id
            );
//        }

//        $user->notify(new MessageReceived($message));

        return redirect(route('conversations.show', ['id' => $user->id]));

    }


}
