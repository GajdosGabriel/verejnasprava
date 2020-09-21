const state = {
    loadingStatus: 'notLoading',
    inter: null
};
const getters = {};

const mutations = {
    SAVE_INTERPELLATION: function(state, item){
        state.inter = item
    }
};

const actions = {

    saveInterpellation({commit}, item){
        console.log(item);
        axios.get('/inter/' + item.id + '/' + item.slug + '/item/interpellation'),
            commit('SAVE_INTERPELLATION', item)
    }

};


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
