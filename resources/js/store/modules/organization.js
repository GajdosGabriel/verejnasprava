const state = {
    organization: {},
    base: [],
    horizontalMenu: [],
    verticalMenu: [],
    paidmodules: [],
};
const getters = {};

const mutations = {

    SET_ORGANIZATION: function (state, payload) {
        state.organization = payload.data;
        state.base = payload.data.menus.base;
        state.horizontalMenu = payload.data.menus.base.filter(menu => menu.type == 'horizontal');
        state.verticalMenu = payload.data.menus.base.filter(menu => menu.type == 'vertical');
        state.paidmodules = payload.data.menus.paidmodules;
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
