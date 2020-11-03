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

    store({commit, dispatch}, item) {
        if (item.vote_status){
            alert('Hlasovanie sa už začalo, interpelácie sú zastavené!');
            return
        }
        axios.post('/api/interpellation/' + item.item.id + '/store', {user: item.user } )
            .then(response => {
                dispatch('items/getItem', item.item.id, {root:true});
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id, {root:true})
            });
    },

    delete({commit, dispatch}, id) {
        axios.delete('/api/interpellation/' + id)
            .then(response => {
                dispatch('items/getItem', id, {root:true});
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id, {root:true})
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
