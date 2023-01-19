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
import store from "./store";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: '/home',
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
            beforeEnter: (to, from, next) => {
                if (!store.state.auth.isAuth) {
                    next('/login')
                } else {
                    next();
                }
            }
        },
        {
            path: '/login',
            component: LoginPage,
            name: 'login-page',
            beforeEnter: (to, from, next) => {
                if (store.state.auth.isAuth) {
                    next('/home')
                } else {
                    next();
                }
            }
        },
        {
            path: '/register',
            component: RegisterPage,
            name: 'register-page',
            beforeEnter: (to, from, next) => {
                if (store.state.auth.isAuth) {
                    next('/home')
                } else {
                    next();
                }
            }
        },
        {
            path: '/:notFound(.*)',
            component: NotFound,
        },
        {
            path: '/social',
            component: SocialPage,
            name: 'social-page',
            beforeEnter: (to, from, next) => {
                if (!store.state.auth.isAuth) {
                    next('/login')
                } else {
                    next();
                }
            }
        },
        {
            path: '/profile',
            component: UserPage,
            name: 'profile',
            beforeEnter: (to, from, next) => {
                if (!store.state.auth.isAuth) {
                    next('/login')
                } else {
                    next();
                }
            }
        },

        {
            path: '/friends',
            component: FriendsPage,
            name: 'friends',
            beforeEnter: (to, from, next) => {
                if (!store.state.auth.isAuth) {
                    next('/login')
                } else {
                    next();
                }
            }
        },

        {
            path: '/tour',
            component: TourPage,
            name: 'tour-page',
            beforeEnter: (to, from, next) => {
                if (!store.state.auth.isAuth) {
                    next('/login')
                } else {
                    next();
                }
            }
        },
        {
            path: '/my-tours',
            component: MyTours,
            name: 'my-tours',
            beforeEnter: (to, from, next) => {
                if (!store.state.auth.isAuth) {
                    next('/login')
                } else {
                    next();
                }
            }
        },

        {
            path: '/admin',
            component: AdminPage,
            name: 'admin',
            beforeEnter: (to, from, next) => {
                if (!store.state.auth.isAuth) {
                    next('/login')
                } else {
                    next();
                }
            }
        },

    ]
});



export default router;
