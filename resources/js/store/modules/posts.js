const state = {
    loadingStatus: 'notLoading',
    posts: []
};


const getters = {};


const actions = {

    fetchPosts: function({commit}, url) {
        commit('SET_LOADING_STATUS', 'loading');
        axios.get(url)
            .then(response => {
                commit('SET_LOADING_STATUS', 'notLoading');
                commit('SET_POSTS', response.data)
            })
    }
};

const mutations = {
    SET_LOADING_STATUS: function (state, status) {
        state.loadingStatus = status
    },
    SET_POSTS: function (state, posts) {
        state.posts = posts;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}