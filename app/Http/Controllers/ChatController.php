<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ChatController extends Controller
{
  /*   public function __construct(){
        $this->middleware('auth');
    }  */

    public function show(Chat $chat){

        abort_unless($chat->users->contains(auth()->id()), 403);
        return view('chat', [
            'chat' => $chat
        ]);
    }

    public function chatWith(Request $request){

        $chat = DB::table('users')
            ->select('chat_user.chat_id')
            ->join('chat_user','chat_user.user_id', '=', 'users.id')
            ->where('chat_user.user_id','=',$request->authUser)
            ->get();

        $chat1 = DB::table('users')
            ->select('chat_user.chat_id')
            ->join('chat_user','chat_user.user_id', '=', 'users.id')
            ->where('chat_user.user_id','=',$request->user)
            ->get();
        
        
            if(count($chat) == 0 || count($chat1) == 0){
                $chat = Chat::create([]);
                $chat->users()->sync([$request->authUser, $request->user]);
    
                 return response()->json([
                    "message" => "La sala de chat se ha creado correctamente",
                    "status" => 200
                ]);            
            }
            
        for($i = 0; $i < count($chat); $i++){
            for($j = 0; $j < count($chat1); $j++){
                if($chat[$i]->chat_id = $chat1[$j]->chat_id){
                    
                    $chat = DB::table('messages')
                    ->select('messages.content','users.name',)
                    ->join('users','messages.user_id', '=', 'users.id')
                    ->where('messages.chat_id', '=', $chat[$i]->chat_id)
                    ->get();

                    return response()->json([
                        "message" => "Estos son los mensajes encontrados para estos usuarios",
                        "users" => $chat,
                        "status" => 200
                    ]);
                }
            }
            $chat = Chat::create([]);
            $chat->users()->sync([$request->authUser, $request->user]);

             return response()->json([
                "message" => "La sala de chat se ha creado correctamente",
                "status" => 200
            ]); 
        }

         return response()->json([
            "message" => "Estos son los mensajes encontrados para estos usuarios",
            "users" => $chat,
            "status" => 200
        ]);

    }


    public function users(){
        $users = DB::table('users')
            ->select('name', 'id')
            ->get();

             return response()->json([
                "message" => "usuarios obtenidos correctamente",
                "users" => $users,
                "status" => 200
            ]);
    }
    
}
