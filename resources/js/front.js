
window.Vue = require('vue');
window.axios = require("axios");
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import App from "./components/App.vue";

import AOS from 'aos'
import 'aos/dist/aos.css'

const app = new Vue({
    el: '#root',
    render: h=>h(App),
    mounted() {
        AOS.init()
    },
}).$mount('#root');

