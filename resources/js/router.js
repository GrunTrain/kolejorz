import {createRouter, createWebHistory} from 'vue-router';

import NotFound from "./pages/NotFound.vue";
import LoginPage from "./pages/LoginPage.vue";
import RegisterPage from "./pages/RegisterPage.vue";
import MyStations from "./pages/MyStations.vue";
import AllStations from "./pages/AllStations.vue";
import SocialPage from "./pages/SocialPage.vue";
import UserPage from "./pages/UserPage.vue";
import FriendsPage from "./pages/FriendsPage.vue";
import TourPage from "./pages/TourPage.vue";
import AdminPage from "./pages/AdminPage.vue";
import MyTours from "./pages/MyTours.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: '/home',
            component: AllStations,
        },
        {
            path: '/home',
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
            name: 'profile',
        },

        {
            path: '/friends',
            component: FriendsPage,
            name: 'friends',
        },

        {
            path: '/tour',
            component: TourPage,
            name: 'tour-page'
        },
        {
            path: '/my-tours',
            component: MyTours,
            name: 'my-tours'
        },

        {
            path: '/admin',
            component: AdminPage,
            name: 'admin'
        },

    ]
});

export default router;
