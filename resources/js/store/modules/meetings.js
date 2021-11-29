const state = {
    meeting: "",
    items: [],
    files: [],
    loadingStatus: false,
    positionActive: false,
};
const getters = {
    activeItem: (state) => (id) => {
        return state.items.find((todo) => todo.id === id);
    },
    allItem: (state) => {
        return state.items;
    },
    publishedItem: (state) => {
        return state.items.filter((todo) => todo.published == 1);
    },
};

const mutations = {
    SET_LOADING_STATUS: function (state, payload) {
        state.loadingStatus = payload;
    },
    SET_MEETING: function (state, meeting) {
        state.meeting = meeting;
        state.files = meeting?.files;
        state.items = meeting?.items.sort((a, b) =>
            a.position > b.position ? 1 : -1
        );
    },

    UPDATE_LIST: function (state, payload) {
        state.items = payload;
    },
    POSITION_ACTIVE: (state, payload) => {
        state.positionActive = payload;
    },
};

const actions = {
    fetchMeeting({ commit }, meeting) {
        commit("SET_LOADING_STATUS", true);
        axios.get(meeting).then((response) => {
            commit("SET_MEETING", response.data.data);
            commit("SET_LOADING_STATUS", false);
        });
    },

    updateMeeting({ commit, dispatch }, [url, meeting]) {
        commit("SET_LOADING_STATUS", true);

        axios
            .put(
                "/api/councils/" + url.council_id + "/meetings/" + url.id,
                meeting
            )
            .then((response) => {
                commit("SET_MEETING", response.data.data);
                commit("SET_LOADING_STATUS", false);

                dispatch(
                    "notification/addNewNotification",
                    { message: "Publikovanie zmenené", type: "bg-green-400" },
                    { root: true }
                );
            });
    },

    storeMeetingUser({ commit, dispatch }, meeting) {
        axios
            .post("/api/meetings/" + meeting.id + "/users", meeting)
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

    updateMeetingUser({ commit, dispatch }, meeting) {
        axios
            .put(
                "/api/meetings/" + meeting.id + "/users/" + meeting.user,
                meeting
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

    deleteMeetingUsers({ commit, dispatch }, meeting) {
        axios
            .delete("/api/meetings/" + meeting.id + "/users/" + meeting.user)
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

    deleteItemMeeting({ commit, dispatch }, item) {
        axios
            .delete(
                "/api/meetings/" +
                    this.state.meetings.meeting.id +
                    "/items/" +
                    item.id
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
