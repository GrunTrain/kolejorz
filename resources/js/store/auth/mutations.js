export default {
    changeStatus(state, payload) {
        state.isAuth = payload;
    },

    setUser(state, payload) {
        state.user = payload;
    }
}
