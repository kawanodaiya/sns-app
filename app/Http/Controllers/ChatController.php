<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Models\Follow;
use App\Models\Status;
use App\Models\StatusUser;
use App\Models\ChatRoom;
use App\Models\ChatRoomUser;
use App\Models\ChatMessage;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Auth;

class ChatController extends Controller
{
    public static function rooms(Request $request){

        $user = $request->user();
        $followings = $user->followings->pluck('id');
        $follow_each = $user->followers->whereIn('id',$followings)->sortByDesc('created_at');

        return view('chat.show', [
            'user' => $user,
            'follow_each' => $follow_each,
        ]);
    }
    public static function show(Request $request){
    
        $user = $request->user();
        //dd($user);
        $followings = $user->followings->pluck('id');
        $follow_each = $user->followers->whereIn('id',$followings)->sortByDesc('created_at');

        $follow_each_user_id = $request->user_id;
        
        // 自分の持っているチャットルームを取得
        $current_user_chat_rooms = ChatRoomUser::where('user_id', Auth::id())->pluck('chat_room_id');
    
        // 自分の持っているチャットルームからチャット相手のいるルームを探す
        $chat_room_id = ChatRoomUser::whereIn('chat_room_id', $current_user_chat_rooms)
            ->where('user_id', $follow_each_user_id)
            ->pluck('chat_room_id');
    
    
        // なければ作成する
        if ($chat_room_id->isEmpty()){
    
            ChatRoom::create();//チャットルーム作成
            
            $latest_chat_room = ChatRoom::orderBy('created_at', 'desc')->first(); //最新チャットルームを取得
    
            $chat_room_id = $latest_chat_room->id;
    
            // 新規登録 モデル側 $fillableで許可したフィールドを指定して保存
            ChatRoomUser::create( 
            ['chat_room_id' => $chat_room_id,
            'user_id' => Auth::id()]);
    
            ChatRoomUser::create(
            ['chat_room_id' => $chat_room_id,
            'user_id' => $follow_each_user_id]);
        }
    
        // チャットルーム取得時はオブジェクト型なので数値に変換
        if(is_object($chat_room_id)){
            $chat_room_id = $chat_room_id->first();
        }
        
        // チャット相手のユーザー情報を取得
        $chat_room_user = User::findOrFail($follow_each_user_id);
        //dd($chat_room_user);
    
        // チャット相手のユーザー名を取得(JS用)
        $chat_room_user_name = $chat_room_user->name;
        //dd($chat_room_user_name);
    
        $chat_messages = ChatMessage::where('chat_room_id', $chat_room_id)
        ->orderby('created_at')
        ->get();
    
        return view('chat.message', 
        compact('chat_room_id', 'chat_room_user','chat_messages',
                'chat_room_user_name','follow_each'));
    
    }

    public function get()
    {
        return ChatMessage::with('user')->get();
    }

    public function send(Request $request)
    {
        $user = Auth::user();

        // $message = $user->messages()->create([
        //     'message' => $request->input('message')
        // ]);

        //$chat_room_id = Auth::user();

        //event(new ChatEvent($user, $message));

        $chat = new ChatMessage();
        $chat->chat_room_id = $request->chat_room_id;
        $chat->user_id = $request->user()->id;
        $chat->message = $request->message;
        $chat->save();

        return ['status' => 'Message Success!'];
    }

    // public static function chat(Request $request){

    //     // $user = Auth::user();

    //     // $message = $user->messages()->create([
    //     //     'message' => $request->input('message')
    //     // ]);

    //     $chat = new ChatMessage();
    //     $chat->chat_room_id = $request->chat_room_id;
    //     $chat->user_id = $request->user()->id;
    //     $chat->message = $request->message;
    //     $chat->save();

    //     event(new ChatEvent($message,$user));
    //     //return ['status' => 'Message Success!'];
    // }

    // public function send(Request $request){
    //     $user=User::find(Auth::id());
    //     event(new ChatEvent($request->message,$user));
    // }
}
