<?php

namespace App\Repository;

use App\Message;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


Class ConversationsRepository {

    private $m;

    public function __construct(Message $message)
    {
        $this->m = $message;

    }


    /**
     * 1: recupere tout les messages en sql ou userId et present
     * 2: recupere que les id de l'interlocuteur
     * 3: rajoute la methode nb de msg unread
     * @param int $userId
     * @return array
     */
    public function getConversations(int $userId){
        $users = [];

        $messages = $this->m->newQuery()
            ->select('from_id' , 'to_id')
            ->Where( 'from_id','=', $userId )
            ->orWhere('to_id','=', $userId)
            ->distinct()
            ->get();



        foreach ($messages as $message){

            if($message->from_id != $userId){
                array_push($users ,\App\User::find($message->from_id));
            }else{
                array_push($users ,\App\User::find($message->to_id));
            }

        }

        $users = array_unique($users);
        $users = array_values(array_filter($users));


        $unread = $this->unreadCount($userId);
        foreach ($users as $user){
            if (isset($unread[$user->id])){
                $user->unread = $unread[$user->id];
            }else{
                $user->unread = 0;
            };
        }


        return $users;
    }


    public function createMessage(string $content, int $from, int $to){
        return $this->m->newQuery()->create([
            'content' => $content,
            'from_id' => $from,
            'to_id' => $to,
            'created_at' => Carbon::now()
        ]);
    }

    public function getMessagesFor(int $from, int $to):Builder{

        return $this->m->newQuery()
            ->whereRaw("((from_id = $from AND to_id = $to ) OR (from_id = $to AND to_id = $from))")
            ->orderBy('created_at', 'DESC')
            ->with([
                'from' => function ($query){
                return $query->select('id', 'first_name', 'image', 'created_at');
                }
            ]);


    }


    /**
     * methode de recuperation du nombre de read_at === NULL par utilisateur
     * @param int $userId
     * @return \Illuminate\Support\Collection|static
     */
    public function unreadCount(int $userId){

        return $this->m->newQuery()
            ->where('to_id', $userId)
            ->groupBy('from_id')
            ->selectRaw('from_id, COUNT(id) as count')
            ->whereRaw('read_at IS NULL')
            ->get()
            ->pluck('count', 'from_id');

    }

    /**
     *
     * @param $from
     * @param $to
     */
    public function readAllFrom(int $from, int $to)
    {

        $this->m->where('from_id', $from)->where('to_id',$to)->update(['read_at' => Carbon::now()]);

    }

    public  function user(int $id){
        return DB::table('users')->newQuery()
            ->select()
            ->Where( 'id','=', $id )
            ->get();


    }

}