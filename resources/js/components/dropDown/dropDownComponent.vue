<template>
    <div class="relative inline-block text-left" v-if="navigations">
        <div>
            <span class="rounded-md shadow-sm">
                <button
                    @click="isOpen = !isOpen"
                    :class="addBackground"
                    class="focus:outline-none  hover:bg-gray-300 p-1 rounded-full transition duration-400 ease-in-out"
                >
                    <svg
                        class="w-4 h-4p-2"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
                        />
                    </svg>
                </button>
            </span>
        </div>

        <div
            v-show="isOpen"
            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg z-10"
        >
            <div v-for="(item, index) in navigations" :key="index">
                <div
                    class="flex cursor-pointer px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-200 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
                    :title="item.title"
                    @click="$emit('fromItem', item.url, item.action)"
                >
                    <component :is="item.icon" class="mr-2"></component>

                    {{ item.name }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import iconEdit from "./itemIcons/editIcon.vue";
import iconDelete from "./itemIcons/deleteIcon.vue";

export default {
    props: ["navigations"],
    components: { iconEdit, iconDelete },
    data() {
        return {
            isOpen: false,
            dropdown: false
        };
    },

    computed: {
        addBackground: function() {
            return this.isOpen ? "bg-gray-400" : "";
        }
    },

    created: function() {
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
