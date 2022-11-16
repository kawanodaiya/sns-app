<div class="container">
    <div class="border-bottom border-dark mb-3">
    <h2 class="py-3 mb-0">チャットルームパートナー:{{$chat_room_user_name}}</h2>
    </div>
    <chat-message :chat-room-id='@json($chat_room_id)'
                :partner-name='@json($chat_room_user_name)'>
    </chat-message>
</div>