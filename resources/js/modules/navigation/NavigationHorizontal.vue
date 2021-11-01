<template>
    <nav
        v-cloak
        class="flex items-center justify-between flex-wrap bg-teal-500 p-3"
    >
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <svg
                class="fill-current h-8 w-8 mr-2"
                width="54"
                height="54"
                viewBox="0 0 54 54"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"
                />
            </svg>
            <span class="font-semibold text-xl tracking-tight">
                <a :href="baseUrl + 'organizations'">
                    {{ organization.name }}
                </a>
            </span>
        </div>
        <div class="block lg:hidden">
            <button
                @click="isOpen = !isOpen"
                class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white"
            >
                <svg
                    class="fill-current h-3 w-3"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <title>
                        Menu
                    </title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow"></div>

            <div class="">
                <a
                    v-for="menu in horizontalMenu"
                    :key="menu.id"
                    class="block mt-4 lg:inline-block lg:mt-0 hover:text-white mr-4"
                    :class="[
                        isOpen ? 'block' : 'hidden',
                        currentUrlSegment == '/' + menu.url
                            ? 'text-white'
                            : 'text-teal-200'
                    ]"
                    :href="baseUrl + menu.url"
                >
                    {{ menu.name }}
                </a>

                <button
                    @click="dropdown = !dropdown"
                    :class="isOpen ? 'block' : 'hidden'"
                    class=" mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4 focus:outline-none"
                >
                    <div class="flex items-center">
                        {{ user.first_name }} {{ user.last_name }}
                        <span class="ml-2">
                            <svg
                                class="fill-current h-4 w-4 transform group-hover:-rotate-180
                              transition duration-150 ease-in-out"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                />
                            </svg>
                        </span>
                    </div>

                    <ul
                        v-show="dropdown"
                        class="dropdown-menu absolute text-gray-700 pt-1 my-2"
                        style="z-index: 99"
                    >
                        <li v-for="menu in verticalMenu" :key="menu.id">
                            <a
                                class="rounded bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap text-left"
                                :href="baseUrl + menu.url"
                                >{{ menu.name }}</a
                            >
                        </li>

                        <li
                            class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap text-left"
                            @click="logout"
                        >
                            Odhlásiť sa
                        </li>
                    </ul>
                </button>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapState } from "vuex";

export default {
    data() {
        return {
            baseUrl: window.App.baseUrl,
            isOpen: false,
            dropdown: false,
            currentUrlSegment: window.location.pathname
        };
    },
    computed: {
        ...mapState("organization", [
            "organization",
            "horizontalMenu",
            "verticalMenu"
        ])
    },
    methods: {
        logout() {
            axios.post("/logout").then(() => (location.href = "/"));
        }
    },
    created: function() {
        this.$store.dispatch(
            "organization/getOrganization",
            "/api/organization/" + this.user.active_organization
        );
        let self = this;

        window.addEventListener("click", function(e) {
            // close dropdown when clicked outside
            if (!self.$el.contains(e.target)) {
                self.isOpen = false;
                self.dropdown = false;
            }
        });
    }
};
</script>
<style>
[v-cloak] {
    display: none;
}
</style>
