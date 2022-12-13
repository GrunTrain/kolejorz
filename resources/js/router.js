import {createRouter, createWebHistory} from 'vue-router';

import NotFound from "./pages/NotFound.vue";
import LoginPage from "./pages/LoginPage.vue";
import RegisterPage from "./pages/RegisterPage.vue";
import MyStations from "./pages/MyStations.vue";
import AllStations from "./pages/AllStations.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', redirect: '/all-stations'},
        {path: '/all-stations', component: AllStations},
        {path: '/my-stations', component: MyStations},
        {path: '/login', component: LoginPage},
        {path: '/register', component: RegisterPage},

        {path: '/:notFound(.*)', component: NotFound},
    ]
});

export default router;
