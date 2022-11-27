import {createRouter, createWebHistory} from 'vue-router';

import TheMainPage from "./pages/TheMainPage.vue";
import NotFound from "./pages/NotFound.vue";
import TheLoginWindow from "./components/layouts/TheLoginWindow.vue";
import TheRegisterWindow from "./components/layouts/TheRegisterWindow.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', component: TheMainPage},
        {path: '/login', component: TheLoginWindow},
        {path: '/register', component: TheRegisterWindow},

        {path: '/:notFound(.*)', component: NotFound},
    ]
});

export default router;
