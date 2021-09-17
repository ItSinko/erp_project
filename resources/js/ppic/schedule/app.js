import Vue from 'vue';
import Notifications from 'vue-notification';
import VueApexCharts from 'vue-apexcharts';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

import '../../bootstrap';

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(Notifications)
Vue.use(VueApexCharts)
// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.component('apexchart', VueApexCharts)

import ButtonHeader from "./ButtonHeader.vue";
import ScheduleApp from "./ScheduleApp.vue";

new Vue({
    el: "#App",
    components: {
        ButtonHeader,
        ScheduleApp,
    },

    data: {
        view: "calendar",
    },

    methods: {
        changeView(data) {
            this.view = data;
        },
    },
});