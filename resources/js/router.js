import {createRouter, createWebHistory} from 'vue-router';

import NotFound from "./pages/NotFound.vue";
import LoginPage from "./pages/LoginPage.vue";
import RegisterPage from "./pages/RegisterPage.vue";
import MyStations from "./pages/MyStations.vue";
import AllStations from "./pages/AllStations.vue";
import SocialPage from "./pages/SocialPage.vue";
import UserPage from "./pages/UserPage.vue";
import TourPage from "./pages/TourPage.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: '/all-stations',
            component: AllStations,
        },
        {
            path: '/home',
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

        {
            path: '/:notFound(.*)',
            component: NotFound,
        },
        {
            path: '/social',
            component: SocialPage,
            name: 'social-page'
        },
        {
            path: '/profile',
            component: UserPage,
            name: 'profile'
        },
        {
            path: '/tour',
            component: TourPage,
            name: 'tour-page'
        },

    ]
});

export default router;
