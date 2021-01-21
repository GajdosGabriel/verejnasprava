import Vue from 'vue'
import Vuex from 'vuex'
import todos from "./modules/todos";
import notification from "./modules/notification";
import posts from "./modules/posts";
import contacts from "./modules/contacts";
import items from "./modules/items";
import councils from "./modules/councils";
import meetings from "./modules/meetings";
import modals from "./modules/modals";
import organization from "./modules/organization";



// import currentUser from "./modules/currentUser";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        todos,
        notification,
        posts,
        contacts,
        items,
        councils,
        meetings,
        modals,
        organization
    }
})
