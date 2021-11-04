const state = {
    user: {},
    organization: {},
    // orgPosts: [],
};
const getters = {
    organization: state => {
        return state.organization
    },
    menuActive: (state) => (id) => {
        return state.organization?.menus?.menuActive.find(item => item.id == id)
    },
    horizontalMenu: state => {
        return state.organization?.menus?.horizontal
    },
    verticalMenu: state => {
        return state.organization?.menus?.vertical
    },
    paidmodules: state => {
        return state.organization?.menus?.paidmodules
    },
    orgPosts: state => {
        return state.organization?.posts?.years_of_posts
    }
};

const mutations = {

    SET_ORGANIZATION: function (state, payload) {
        state.user = payload.data;
        state.organization = payload.data.organization;
    },

};
const actions = {

    getOrganization({commit}) {
        axios.get('/api/user')
            .then(response => {
                    commit('SET_ORGANIZATION', response.data);
                }
            );
    },

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
