const state = {
    organization: {},
    horizontalMenu: [],
    verticalMenu: [],
    menuactive: [],
    paidmodules: [],
    yearsOfPosts: []

};
const getters = {};

const mutations = {

    SET_ORGANIZATION: function (state, payload) {
        state.organization = payload.data;
        state.horizontalMenu = payload.data.menus.filter(menu => menu.type == 'horizontal');
        state.verticalMenu = payload.data.menus.filter(menu => menu.type == 'vertical');
        state.menuactive = payload.data.menuactive;
        state.paidmodules = payload.data.paidmodules;
        state.yearsOfPosts = payload.data.years_of_posts;
    },

};
const actions = {

    getOrganization({commit}, url) {
        axios.get(url)
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
