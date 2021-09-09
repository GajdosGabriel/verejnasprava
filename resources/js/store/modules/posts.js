const state = {
    loadingStatus: false,
    posts: [],
    urlPostFront: 'posts/frontPostsTable'
};


const getters = {};

const mutations = {
    SET_LOADING_STATUS: function (state, status) {
        state.loadingStatus = status
    },
    SET_POSTS: function (state, posts) {
        state.posts = posts;
    }
};

const actions = {

    fetchPosts: function({commit}, url) {
        commit('SET_LOADING_STATUS', 'loading');
        axios.get(url)
            .then(response => {
                commit('SET_LOADING_STATUS', true);
                commit('SET_POSTS', response.data);
                commit('SET_LOADING_STATUS', false);
            })
    },

    editPost: function({commit}, url) {
        window.location.replace(url);
    }
};



export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
