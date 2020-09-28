const state = {
    showModal: false

};
const getters = {};

const mutations = {
    OPEN_FORM(state){
        state.showModal =! state.showModal
    }

};
const actions = {
    open_form ({commit}, payload) {
        commit('OPEN_FORM');
        commit('councils/SET_COUNCIL', payload, {root: true});
    }



};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
