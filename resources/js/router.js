import {createRouter, createWebHistory} from 'vue-router';

import NotFound from "./pages/NotFound.vue";
import LoginPage from "./pages/LoginPage.vue";
import RegisterPage from "./pages/RegisterPage.vue";
import MyStations from "./pages/MyStations.vue";
import AllStations from "./pages/AllStations.vue";
import AddTour from "./pages/AddTour.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: '/all-stations',
            component: AllStations,

        },
        {
            path: '/all-stations',
            component: AllStations,
            name: 'all-stations',


        },
        {
            path: '/my-stations',
            component: MyStations,
            name: 'my-stations',

        },
        {
            path: '/login',
            component: LoginPage,
            name: 'login-page',

        },
        {
            path: '/register',
            component: RegisterPage,
            name: 'register-page',

        },
        // to be adjusted
        {
            path: '/add-tour',
            component: AddTour,
            name: 'add-tour',
        },
        // to be adjusted
        {
            path: '/:notFound(.*)',
            component: NotFound,

        },
    ]
});

export default router;
