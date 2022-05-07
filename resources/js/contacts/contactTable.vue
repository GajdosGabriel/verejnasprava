<template>
    <div>
        <div class="flex justify-between mb-6">
            <h1 class="font-bold text-2xl">Kontakty</h1>
            <new-contact-button />
        </div>

        <div class="flex items-center">
            <search-form @emitForm="searchForm"></search-form>

            <div class="ml-4 mr-2">
                <input
                    type="checkbox"
                    id="deleted"
                    name="horns"
                    v-model="deletedContacts"
                />
                <label for="deleted">Zmazané</label>
            </div>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-300">
                    <th class="table-header whitespace-no-wrap">Názov firmy</th>
                    <th class="table-header">Ulica</th>
                    <th class="table-header">Mesto</th>
                    <th class="table-header">Psč</th>
                    <th class="table-header">Ičo</th>
                    <th class="table-header">Dič</th>
                    <th class="table-header" v-if="$auth.isAdmin()">Email</th>
                    <th class="table-header">Tel.</th>
                    <th class="table-header">Panel</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="hover:bg-gray-200"
                    v-for="contact in contacts.data"
                    :key="contact.id"
                >
                    <td class="table-data">
                        <a :href="contact.url.show">{{ contact.name }}</a>
                    </td>
                    <td class="table-data" v-text="contact.street"></td>
                    <td
                        class="table-data whitespace-no-wrap"
                        v-text="contact.city"
                    ></td>
                    <td class="table-data whitespace-no-wrap">
                        {{ contact.psc | pscFormat }}
                    </td>
                    <td class="table-data" v-text="contact.ico"></td>
                    <td class="table-data" v-text="contact.dic"></td>
                    <td class="table-data" v-if="$auth.isAdmin()">
                        <a href="mailto: contact.email">{{ contact.email }}</a>
                    </td>
                    <td class="table-data whitespace-no-wrap">
                        <a href="tel: contact.phone">{{ contact.phone }}</a>
                    </td>
                    <td class="table-data text-center">
                        <drop-down-component
                            :items="contact"
                            @fromItem="clickOnItem"
                        ></drop-down-component>

                        <!-- <button
                            class="hover:underline cursor-pointer text-sm"
                            @click="clickOnDeleteButton(contact)"
                        >
                            Obnoviť
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
    components: {
        paginator,
        formEdit,
        newContactButton,
        searchForm,
        dropDownComponent,
    },
    mixins: [filterMixin],
    data: function () {
        return {
            numeral: numeral,
            search: "",
            deletedContacts: false,
            url:
                "/api/organizations/" +
                this.user.active_organization +
                "/contacts",
        };
    },
    computed: mapState({
        contacts: (state) => state.contacts.contacts,
    }),
    created() {
        this.fetchContacts(this.url);
    },
    watch: {
        search: function (val) {
            this.fetchContacts(this.url + "?multi=" + this.search);
        },
        deletedContacts: function (val) {
            this.fetchContacts(
                this.url + [this.deletedContacts ? "?deletedContacts=true" : ""]
            );
        },
    },
    methods: {
        ...mapActions([
            "newContactToggle",
            "openEditForm",
            "filterContact",
            "fetchContacts",
        ]),

        changePaginateUrl(path) {
            this.url = path;
            this.fetchContacts(this.url);
        },
        searchForm(val) {
            this.search = val;
        },
        clickOnItem(action, item) {
            if (action == "show") {
                window.location.href = item.navigations.show.url;
            }

            if (action == "edit") {
                this.openEditForm(item);
            }

            if (action == "delete") {
                if (!window.confirm("Skutočne zmazať položku?")) {
                    return;
                }
                this.$store.dispatch("contacts/deleteContact", item);

                this.fetchContacts(this.url);
            }
        },
    },
};
</script>
