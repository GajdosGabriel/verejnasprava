<template>
    <div>
        <div class="flex justify-between mb-6">
            <h1 class="font-bold text-2xl">Kontakty</h1>
            <new-contact-button />
        </div>

        <search-form @emitForm="searchForm"></search-form>

        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-300">
                    <th class="px-4 py-2 whitespace-no-wrap">Názov firmy</th>
                    <th class="px-4 py-2">Ulica</th>
                    <th class="px-4 py-2">Mesto</th>
                    <th class="px-4 py-2">Psč</th>
                    <th class="px-4 py-2">Ičo</th>
                    <th class="px-4 py-2">Dič</th>
                    <th class="px-4 py-2" v-if="$auth.isAdmin()">Email</th>
                    <th class="px-4 py-2">Tel.</th>
                    <th class="px-4 py-2" v-if="$auth.isAdmin()">Panel</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="hover:bg-gray-200"
                    v-for="contact in contacts.data"
                    :key="contact.id"
                >
                    <td class="px-4 py-2 border">
                        <a
                            :href="
                                /organizations/ +
                                    contact.organization_id +
                                    /contacts/ +
                                    contact.id
                            "
                            >{{ contact.name }}</a
                        >
                    </td>
                    <td class="px-4 py-2 border" v-text="contact.street"></td>
                    <td
                        class="px-4 py-2 border whitespace-no-wrap"
                        v-text="contact.city"
                    ></td>
                    <td class="px-4 py-2 border whitespace-no-wrap">
                        {{ contact.psc | pscFormat }}
                    </td>
                    <td class="px-4 py-2 border" v-text="contact.ico"></td>
                    <td class="px-4 py-2 border" v-text="contact.dic"></td>
                    <td class="px-4 py-2 border" v-if="$auth.isAdmin()">
                        <a href="mailto: contact.email">{{ contact.email }}</a>
                    </td>
                    <td class="px-4 py-2 border whitespace-no-wrap">
                        <a href="tel: contact.phone">{{ contact.phone }}</a>
                    </td>
                    <td
                        class="px-4 py-2 border text-center"
                        v-if="$auth.isAdmin()"
                    >
                        <drop-down-component
                            :items="contact"
                            @fromItem="clickOnItem"
                        ></drop-down-component>

                        <!-- <button
                            class="hover:underline cursor-pointer text-sm"
                            @click="openEditForm(contact)"
                        >
                            Upraviť
                        </button> -->
                    </td>
                </tr>
            </tbody>
        </table>

        <paginator :data="contacts" @pathUrl="changePaginateUrl" />

        <form-edit></form-edit>
    </div>
</template>

<script>
import dropDownComponent from "../components/dropDown/dropDownComponent";
import searchForm from "../components/SearchForm";
import newContactButton from "./newContactButton.vue";
import formEdit from "./formEdit.vue";
import paginator from "../modules/pagination";
import numeral from "numeral";
import { mapState } from "vuex";
import { filterMixin } from "../mixins/filterMixin";

import { createNamespacedHelpers } from "vuex";

const { mapActions } = createNamespacedHelpers("contacts");

export default {
    components: { paginator, formEdit, newContactButton, searchForm, dropDownComponent },
    mixins: [filterMixin],
    data: function() {
        return {
            numeral: numeral,
            search: "",
            url:
                "/api/organizations/" +
                this.user.active_organization +
                "/contacts"
        };
    },
    computed: mapState({
        contacts: state => state.contacts.contacts
    }),
    created() {
        this.fetchContacts(this.url);
    },
    watch: {
        search: function(val) {
            this.fetchContacts(this.url + "?multi=" + this.search);
        }
    },
    methods: {
        ...mapActions([
            "newContactToggle",
            "openEditForm",
            "filterContact",
            "fetchContacts"
        ]),

        changePaginateUrl(path) {
            this.url = path;
            this.fetchContacts(this.url);
        },
        searchForm(val) {
            this.search = val;
        },
        clickOnItem(action, post) {
                            console.log(post);
            if (action == "edit") {

                this.openEditForm(post);
            }

            if (action == "delete") {
                this.deletePost(post);
            }
        }
    }
};
</script>
