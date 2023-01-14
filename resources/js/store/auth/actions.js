export default {
    setAuth(context) {
        axios.get('/api/user')
            .then(response => {
                if (response.data) {
                    context.commit('changeStatus', true)
                    context.commit('setUser', response.data)
                }
            }).catch(() => {
            context.commit('changeStatus', false)
        });
    },
}
