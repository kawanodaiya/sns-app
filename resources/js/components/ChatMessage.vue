<!-- <template>
    <li class="list-group-item "><slot></slot></li>
</template>

<script>
    export default {
        data:{
            message:'',
            chat:{
                message:[]
            }
        },
        methods:{
            send(){
                if(this.message.length !=0){
                //console.log(this.message);
                    this.chat.message.push(this.message);
                    axios.post('/send', {
                        message: this.message
                    })
                    .then(response => {
                        console.log(response);
                        this.message = '';
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
            },
        },
        mounted(){
            window.Echo.private('chat')
            .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message);
                console.log(e);
            });
        }
    }
</script> -->

<template>
    <div>
        <div class="d-flex flex-row">
            <div class="w-100">
                <input v-model="text" class="form-control" />
            </div>
            <div>
                <button @click="postMessage" :disabled="!textExists" class="btn-sm shadow-none border border-success bg-success text-white p-1">
            <i class="p-1 fa-lg fas fa-play"></i>
        </button>
            </div>
        </div>
        <ul>
            <li v-for="(message, key) in messages" :key="key">
                <div v-if="message.chat_room_id === chatRoomId">
                    <strong>{{ message.user.name }}</strong>
                    {{ message.message }}
                </div>
            </li>
        </ul>
        <p>{{chatRoomId}}</p>
    </div>
</template>

<script>
export default {
    props: {
        chatRoomId: String,
    },
    data() {
        return {
            text: '',
            messages: [],
        };
    },
    computed: {
        textExists() {
            return this.text.length > 0;
        }
    },
    created() {
        this.getMessages();
        Echo.private('chat').listen('ChatEvent', e => {
            this.messages.push({
                user: e.user,
                message: e.message.message,
                chat_room_id: e.chatRoomId,
            });
        });
    },
    methods: {
        getMessages() {
            axios.get('/chat/messages').then(response => {
                this.messages = response.data;
            });
        },
        postMessage(message) {
            axios.post('/chat/messages', { 
                message: this.text, 
                chat_room_id: this.chatRoomId
            }).then(response => {
                this.text = '';
            });
        }
    }
};
</script>

<!-- <template>
    <div>
        <ul>
            <li v-for="(message, key) in messages" :key="key">
                <strong>{{ message.user.name }}</strong>
                {{ message.message }}
            </li>
        </ul>
        <input v-model="text">
        <button @click="postMessage" :disabled="!textExists">Submit</button>
        <form class="messageInputForm">
            <div class='container'>
            <input type="text" data-behavior="chat_message" class="messageInputForm_input" placeholder="メッセージを入力...">
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            text: "",
            messages: []
        };
    },
    computed: {
        textExists() {
            return this.text.length > 0;
        }
    },
    // created() {
    //     this.getMessages();
    //     Echo.private('chat').listen('ChatEvent', e => {
    //         this.messages.push({
    //             message: e.message.message,
    //             user: e.user
    //         });
    //     });
    // },
    methods: {
        // getMessages() {
        //     axios.get('/chat/show/chat').then(response => {
        //         this.messages = response.data;
        //     });
        // },
        postMessage(message) {
            axios.post('/chat/show/chat', { 
                message: this.text 
            },)
            .then((response) => {
                console.log(response);
            })
            .catch((err) => {
                console.log(err);
            });
        }
    }
};
</script> -->

<!-- $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.messageInputForm_input').keypress(function (event) {
        if(event.which === 13){
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/chat/chat',
                data: {
                    chat_room_id: chat_room_id,
                    user_id: user_id,
                    message: $('.messageInputForm_input').val(),
                },
            
            })
            
            .done(function(data){
                //console.log(data);
                event.target.value = '';
            });

        }
    });

    window.Echo.channel('chat')
    .listen('ChatEvent', (e) => {
        console.log(e, e.message.user_id);
        if(e.message.user_id === user_id){
            console.log(true);
        $('.messages').append(
            '<div class="message"><span>' + current_user_name + 
            ':</span><div class="commonMessage"><div>' +
            e.message.message + '</div></div></div>');
        }else{
            console.log(false);
        $('.messages').append(
            '<div class="message"><span>' + chat_room_user_name + 
            ':</span><div class="commonMessage"><div>' +
            e.message.message + '</div></div></div>');    
        }
    });


}); -->
