const state = {
    loadingStatus: false,
    posts: [],
    urlPostFront: "posts/frontPostsTable"
};

const getters = {};

const mutations = {
    SET_LOADING_STATUS: function(state, status) {
        state.loadingStatus = status;
    },
    SET_POSTS: function(state, posts) {
        state.posts = posts;
    },

    REMOVE_POST: function(state, post) {
        state.posts.data = state.posts.data.filter(p => p.id !== post.id);
    }
};

const actions = {
    fetchPosts: function({ commit }, url) {
        commit("SET_LOADING_STATUS", "loading");
        axios.get(url).then(response => {
            commit("SET_LOADING_STATUS", true);
            commit("SET_POSTS", response.data);
            commit("SET_LOADING_STATUS", false);
        });
    },

    editPost: function({ commit }, url) {
        window.location.replace(url);
    },

    deletePost: function({ commit }, url) {
        axios.delete(url).then(response => {

            commit("REMOVE_POST", response.data);


            // Notify for delete post
            commit(
                "notification/NEW_NOTIFICATION",
                {
                    type: "bg-green-400",
                    message: "Doklad uložený!"
                },
                { root: true }
            )
                // window.location.reload();
        });
    },

    frontedPosts: function({ commit }, url) {
        axios.get(url).then(response => {
            commit("SET_LOADING_STATUS", true);
            commit("SET_POSTS", response.data);
            commit("SET_LOADING_STATUS", false);
        });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
