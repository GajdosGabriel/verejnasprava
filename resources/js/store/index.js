import Vue from 'vue'
import Vuex from 'vuex'
import todos from "./modules/todos";
import notification from "./modules/notification";
// import currentUser from "./modules/currentUser";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        todos,
        notification
    }
})
