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

const app = createApp({
    el: '#app',
    components: {
        ArticleLike,
        ChatMessage,
        FollowButton,
    },
});

app.mount('#app');
