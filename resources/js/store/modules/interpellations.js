const state = {
    loadingStatus: 'notLoading'

};
const getters = {};

const mutations = {
    OPEN_LIST: function (state){
        state.openList = ! state.openList
    }


};
const actions = {

    store({commit, dispatch}, payload) {
        if (payload.vote_status){
            alert('Hlasovanie sa už začalo, interpelácie sú zastavené!');
            return
        }
        axios.post('/api/interpellation/' + payload.id + '/store', {user: payload.user.id } )
            .then(response => {
                dispatch('meetings/fetchMeeting', payload.meeting_id, {root:true})
            });
    },

    delete({commit, dispatch}, payload) {
        axios.delete('/api/interpellation/' + payload.id)
            .then(response => {
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
