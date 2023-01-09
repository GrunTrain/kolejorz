import {createStore} from "vuex";
import authModule from "@/store/auth/index";

const store = createStore({
    modules: {
        auth: authModule,
    },
});

export default store;
