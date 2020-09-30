const state = {
    loadingStatus: 'notLoading',

};
const getters = {};

const mutations = {


};
const actions = {

    saveInterpellation({commit, dispatch}, payload) {
        axios.post('/api/interpellation/' + payload.id + '/store', {user: payload.user.id } )
            .then(response => {
                dispatch('meetings/fetchMeeting', payload.meeting_id, {root:true})
            });
    },

    deleteInterpellation({commit, dispatch}, payload) {
        axios.delete('/api/interpellation/' + payload.id)
            .then(response => {
                // commit('SET_INTERPELLATIONS', response.data )
                dispatch('meetings/fetchMeeting', payload.meeting, {root:true})
            });
    },

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
