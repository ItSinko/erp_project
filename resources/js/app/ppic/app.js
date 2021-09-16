import Vue from 'vue';
import Notifications from 'vue-notification';

import App from "./App.vue";

Vue.use(Notifications);

var app = new Vue({
    el: "#app",
    components: {
        Test: App,
    }
})