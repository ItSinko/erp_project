require('./bootstrap');

window.Vue = require('vue');

Vue.component('chat-messages', require('./components/ChatMessage.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        messages: [],
        count: 0,
    },
    created() {
        this.fetchMessage();
    },
    methods: {
        fetchMessage() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },
        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        }
    },
});