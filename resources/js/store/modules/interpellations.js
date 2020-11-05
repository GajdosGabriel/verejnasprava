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

    update({commit, dispatch}, item) {
        if (item.vote_status){
            alert('Hlasovanie sa už začalo, interpelácie sú zastavené!');
            return
        }
        axios.put('/interpellations/' + item.id )
            .then(response => {
                dispatch('items/getItem', item.id, {root:true});
                dispatch('meetings/fetchMeeting', this.state.meetings.meeting.id, {root:true})
            });
    },

    delete({commit, dispatch}, id) {
        axios.delete('/interpellations/' + id)
            .then(response => {
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
