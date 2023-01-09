export default {
    setAuth(context) {
        context.commit('changeStatus', true)
    },

    setUnauth(context) {
        context.commit('changeStatus', false)
    }
}
