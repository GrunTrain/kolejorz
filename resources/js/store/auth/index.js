import authMutations from "@/store/auth/mutations";
import authActions from "@/store/auth/actions";
import authGetters from "@/store/auth/getters";

export default {
    namespaced: true,
    state() {
        return {
            isAuth: false,
            user: null
        }
    },

    mutations: authMutations,
    actions: authActions,
    getters: authGetters
}
