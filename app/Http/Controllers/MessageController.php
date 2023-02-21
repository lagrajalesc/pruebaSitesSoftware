<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    
/*     public function __construct(){
        $this->middleware('auth');
    }  */

    public function messageSent(Request $request){

        if(empty($request->content)){
            return response()->json([
                "message" => "Debe enviar un mensaje",
                "status" => 400
            ]);
        }

         $messageSet = DB::table('messages')
            ->insert([
                "user_id" => $request->user_id,
                "chat_id" => $request->chat_id,
                "content" => $request->content
            ]); 

        return response()->json([
            "message" => "Mensaje enviado correctamente",
            "status" => 200
        ]);
    }

}
