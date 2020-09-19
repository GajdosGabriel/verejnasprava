const state = {
    loadingStatus: 'notLoading',
    inter: []
};
const getters = {};

const mutations = {
    SAVE_INTERPELLATION: function(state, item){
        state.inter.push('xxxxxx')
    }
};
const actions = {

    saveInterpellation({commit}, item){
        axios.get('/inter/' + item.id + '/' + item.slug + '/item/interpellation'),
            commit('SAVE_INTERPELLATION', item)
    }

};

;

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
