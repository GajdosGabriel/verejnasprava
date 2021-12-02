const state = {
    interpellations: [],
    votes: [],
    files: [],
    item: "",
    user: "",
};

const getters = {
    resultYes: (state) => {
        return state.item.votes;
    },

    // get_votes: (state) => {
    //     return state.votes.find(todo => todo.user_id == 1)
    // }
};

const mutations = {
    SET_ITEM: function (state, item) {
        state.item = item;
        state.user = item.user;
        state.votes = item.votes;
        state.files = item.files;
        state.interpellations = item.interpellations;
    },

    SET_VOTES: function (state, item) {
        state.votes = item;
    },

    SET_INTERPELLATIONS: function (state, item) {
        state.interpellations = item;
    },
    PUBLISHED_STATUS: function (state, item) {
        item.published = !item.published;
    },
};
const actions = {
    getItem({ commit }, item) {
        axios.get("/api/organizations/" + item.organization_id + "/items/" + item.id).then((response) => {
            commit("SET_ITEM", response.data.data);
        });
    },

    storeVote({ commit, dispatch }, item) {
        axios.put("/api/votes/" + item.id, item).then((response) => {
            commit("SET_ITEM", response.data);
        });
    },

    deleteItem({ commit, dispatch }, item) {

        axios.delete("/api/organizations/" + item.organization_id + "/items/" + item.id).then((response) => {
            commit("SET_ITEM", response.data);
            location.href = "/items";
        });
    },

    updateItem({ commit, dispatch }, item) {
        axios.put("/api/organizations/" + item.organization_id + "/items/" + item.id, item).then((response) => {
            // console.log(response.headers.notification);
            commit("SET_ITEM", response.data.data);
            dispatch(
                "meetings/fetchMeeting",
                "/api/councils/" +
                    this.state.meetings.meeting.council_id +
                    "/meetings/" +
                    this.state.meetings.meeting.id,
                { root: true }
            );

            // Notify for add task
            dispatch(
                "notification/addNewNotification",
                {
                    message: response.headers.notification,
                    type: "bg-green-400",
                },
                { root: true }
            );
        });
    },
    // Using user of meeting
    updateInterpellation({ commit, dispatch }, item) {
        if (item.vote_status) {
            alert("Hlasovanie sa už začalo, interpelácie sú zastavené!");
            return;
        }
        axios
            .put("/api/items/" + item.id + "/interpellations/" + item.id)
            .then((response) => {
                dispatch(
                    "meetings/fetchMeeting",
                    "/api/councils/" +
                        this.state.meetings.meeting.council_id +
                        "/meetings/" +
                        this.state.meetings.meeting.id,
                    { root: true }
                );
            });
    },

    // Using admin of meeting
    deleteInterpellation({ commit, dispatch }, [item, interpellation]) {
        axios
            .delete(
                "/api/items/" +
                    item.id +
                    "/interpellations/" +
                    interpellation.id
            )
            .then((response) => {
                dispatch(
                    "meetings/fetchMeeting",
                    "/api/councils/" +
                        this.state.meetings.meeting.council_id +
                        "/meetings/" +
                        this.state.meetings.meeting.id,
                    { root: true }
                );
            });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
