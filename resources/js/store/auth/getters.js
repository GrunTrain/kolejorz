export default {
    getStatus(state) {
        return state.isAuth;
    },

    getUserData(state) {
      return state.user;
    },
};
