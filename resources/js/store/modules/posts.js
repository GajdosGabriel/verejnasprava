const state = {
    posts: []
};


const getters = {};


const actions = {
    loadPosts: function({commit}, url) {
        axios.get(url)
            .then(response => {
                commit('SET_POSTS', response.data.data)
            })
    }
};

const mutations = {
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
