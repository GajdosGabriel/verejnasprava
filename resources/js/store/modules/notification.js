const state = {
    notifications: []
};
const getters = {};
const mutations = {
    NEW_NOTIFICATION: function(state, notification) {
        state.notifications.push({
            ...notification,
            id: (Math.random().toString(36) + Date.now().toString(36)).substr(2)
        });
    },

    REMOVE_NOTIFICATION: function (state, removeNotification) {
        state.notifications = state.notifications.filter(notification => {
            return notification.id != removeNotification.id;
        })

    }


};
const actions = {
    addNewNotification: function ({commit}, notification) {
        if (! notification.message == ""){
            commit('NEW_NOTIFICATION', notification)
        }
    },

    removeNotification: function ({commit}, notification) {
        commit('REMOVE_NOTIFICATION', notification)
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
