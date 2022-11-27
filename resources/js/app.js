import './bootstrap';
import {createApp} from 'vue';

import router from './router.js';
import App from './App.vue';
import TheMap from "./components/layouts/TheMap.vue";

import BaseButton from "./components/UI/BaseButton.vue";
import BaseCard from "./components/UI/BaseCard.vue";


const app = createApp(App);

app.use(router);

app.component('the-map', TheMap);
app.component('base-button', BaseButton);
app.component('base-card', BaseCard);

app.mount('#app');
