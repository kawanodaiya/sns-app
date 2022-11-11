<div class="container">
    <span>{{$chat_room_user_name}}</span>
    <div class="messagesArea messages">
        @foreach($chat_messages as $message)
        <div class="message">
        @if($message->user_id = Auth::id())
            <span>{{Auth::user()->name}}</span>
        @else
            <span>{{$chat_room_user_name}}</span>
        @endif
        </div>
        @endforeach
        <ul class="list-group">
            <!-- <message v-for="value in chat.message">
            @{{value}}
            </message> -->
            <article-like></article-like>
        </ul>
        <input type="text" class="form-control" placeholder="Type your message here.." v-model='message' @keyup.enter='send'>
    </div>
    <form class="messageInputForm" method="post">
        <div class='container'>
        <input type="text" class="form-control" placeholder="Type your message here.." 
                v-model='message' @keyup.enter='send'>
        </div>
    </form>
</div>