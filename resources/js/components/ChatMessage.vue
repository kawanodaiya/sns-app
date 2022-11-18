<template>
    <div class="chat-body">
        <div class="d-flex flex-row chat-form">
            <div class="w-100">
                <input v-model="text" class="form-control" />
            </div>
            <div>
                <button @click="postMessage" :disabled="!textExists" class="btn-sm shadow-none border border-success bg-success text-white p-1">
                    <i class="p-1 fa-lg fas fa-play"></i>
                </button>
            </div>
        </div>
        <ul class="bg-light rounded message-container">
            <li v-for="(message, key) in messages" :key="key">
                <div v-if="message.chat_room_id === chatRoomId" class="my-3">

                    <div v-if="message.user.name === partnerName">
                        <div class="card border border-success shadow-0">
                            <div class="card-body user-text">
                                {{ message.message }}
                            </div>
                        </div>
                        <div class="user-name">
                            <strong>{{message.user.name}}</strong>
                        </div>
                    </div>
                    <div v-else>
                        <div class="card border border-primary shadow-0">
                            <div class="card-body user-text">
                                {{ message.message }}
                            </div>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <div class="user-name">
                                <strong class="positon-right">{{message.user.name}}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        chatRoomId: String,
        partnerName: String,
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
                message: e.message,
                chat_room_id: e.chat_room_id,
            });
            console.log(messages.user);
        });
    },
    mounted() {
        window.Echo.private('chat')
        .listen('ChatEvent', (e) => {
            console.log(e.user);
            console.log(e.message);
            console.log(e.chat_room_id);
        });
    },
    methods: {
        getMessages() {
            axios.get('/chat/messages').then(response => {
                this.messages = response.data;
                //chat_room_id = this.chatRoomId
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
