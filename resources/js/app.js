/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import ArticleLike from './components/ArticleLike.vue';
import ChatMessage from './components/ChatMessage.vue';
import FollowButton from './components/FollowButton.vue';

//require('./chat'); 

//Vue.component('message', require('./components/ChatMessage.vue').default);

// const app = new Vue({
//     el: '#app',
//     components: {
//         ArticleLike,
//         ArticleTagsInput,
//     }
// })

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({
    el: '#app',
    components: {
        ArticleLike,
        ChatMessage,
        FollowButton,
    },
    // data:{
    //     message:'',
    //     chat:{
    //         message:[]
    //     }
    // },
    // methods:{
    //     send(){
    //         if(this.message.length !=0){
    //             //console.log(this.message);
    //             this.chat.message.push(this.message);
    //             axios.post('/send', {
    //             message: this.message
    //             })
    //             .then(response => {
    //                 console.log(response);
    //                 this.message = '';
    //             })
    //             .catch(error => {
    //                 console.log(error);
    //             });
    //         }
    //     }
    // },
    // mounted(){
    //     window.Echo.private('chat')
    //     .listen('ChatEvent', (e) => {
    //     this.chat.message.push(e.message);
    //     console.log(e);
    //     });
    // }
});

// app.mount("#app");

//import ExampleComponent from './components/ExampleComponent.vue';
// app.component('ArticleLike', ArticleLike);
// app.component('ArticleTagsInput', ArticleTagsInput);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');

// $(document).ready(function() {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $('.messageInputForm_input').keypress(function (event) {
//         if(event.which === 13){
//             event.preventDefault();
//             $.ajax({
//                 type: 'POST',
//                 url: '/chat/chat',
//                 data: {
//                     chat_room_id: chat_room_id,
//                     user_id: user_id,
//                     message: $('.messageInputForm_input').val(),
//                 },
            
//             })
            
//             .done(function(data){
//                 //console.log(data);
//                 event.target.value = '';
//             });

//         }
//     });

//     window.Echo.channel('chat')
//     .listen('ChatEvent', (e) => {
//         console.log(e, e.message.user_id);
//         if(e.message.user_id === user_id){
//             console.log(true);
//         $('.messages').append(
//             '<div class="message"><span>' + current_user_name + 
//             ':</span><div class="commonMessage"><div>' +
//             e.message.message + '</div></div></div>');
//         }else{
//             console.log(false);
//         $('.messages').append(
//             '<div class="message"><span>' + chat_room_user_name + 
//             ':</span><div class="commonMessage"><div>' +
//             e.message.message + '</div></div></div>');    
//         }
//     });


// });
