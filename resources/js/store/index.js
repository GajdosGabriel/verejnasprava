import Vue from 'vue'
import Vuex from 'vuex'
import tasks from "./modules/Tasks";
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
        tasks,
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
