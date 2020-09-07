const state = {
    showModal: false,
    contact: []
};
const getters = {};

const mutations = {
    SHOW_MODAL: function(state, data){
        state.showModal =! state.showModal;
        state.contact = data
    }
};
const actions = {
    modalToggle({commit}, data){
        commit('SHOW_MODAL', data)
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
