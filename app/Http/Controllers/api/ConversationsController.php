<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Repository\ConversationsRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{

    private $ConversationsRepository;

    public function __construct(ConversationsRepository $ConversationsRepository)
    {
        $this->ConversationsRepository = $ConversationsRepository;
    }

    public function index(Request $request)
    {
        $conversations = $this->ConversationsRepository->getConversations($request->user()->id);
        $unread = $this->ConversationsRepository->unreadCount($request->user()->id);

        foreach ($conversations as $conversation) {
            if (isset($unread[$conversation->id])) {
                $conversation->unread = $unread[$conversation->id];

            } else {
                $conversation->unread = 0;
            }
        }

        return [
            'conversations' => $conversations
        ];
    }

    public function show(Request $request, User $user)
    {

        if ($user === Auth::user()){
            return [
                'redirect'=> false
            ];

        }else{

            $redirect = true;

            $messagesQuery = $this->ConversationsRepository->getMessagesFor($request->user()->id, $user->id);

            $count = "";
            if ($request->get('before')) {
                $messagesQuery = $messagesQuery->where('created_at', '<', $request->get('before'));
            } else {
                $count = $messagesQuery->count();
            }
            $messages = $messagesQuery->limit(10)->get();
            $update = false;
            foreach ($messages as $message){
                if ($message->read_at === null && $message->to_id === $request->user()->id) {
                    $message->read_at = Carbon::now();
                    if ($update === false){
                        $this->ConversationsRepository->readAllFrom($message->from_id, $message->to_id);
                    }
                    $update = true;
                }
            }

            return [

                'takeUser' => $user,
                'messages' => array_reverse($messages->toArray()),
                'me' => Auth::user(),
                'count' => $count,
                'redirect'=> $redirect = true
            ];
        }

    }


    public function store(User $user, StoreMessageRequest $request)
    {

//        if($user !== Auth::user()){

        $message = $this->ConversationsRepository->createMessage(
            $request->get('content'),
            $request->user()->id,
            $user->id
        );
//        }

//        $user->notify(new MessageReceived($message));
        broadcast(new NewMessages($message));

        return [
            'message' => $message
        ];

    }

}