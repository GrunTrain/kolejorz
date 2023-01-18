import './bootstrap';
import {createApp} from 'vue';

import store from './store/index.js';
import router from './router.js';

import App from './App.vue';
import TheMap from "./components/layouts/TheMap.vue";
import BaseButton from "./components/UI/BaseButton.vue";
import FlashMessage from '@smartweb/vue-flash-message';


const app = createApp(App);

app.use(store);
app.use(router);
app.use(FlashMessage);

app.component('base-button', BaseButton);

app.mount('#app');
