<template>
    <div class="relative inline-block text-left" v-if="items">
        <div>
            <span class="rounded-md shadow-sm">
                <button
                    @click="isOpen = !isOpen"
                    :class="addBackground"
                    class="
                        focus:outline-none
                        hover:bg-gray-300
                        p-1
                        rounded-full
                        transition
                        duration-400
                        ease-in-out
                    "
                >
                    <svg
                        class="w-4 h-4"
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
            class="
                origin-top-right
                absolute
                right-0
                mt-2
                w-56
                rounded-md
                shadow-lg
                z-10
                bg-white
            "
        >
            <div v-for="(item, index) in items.navigations" :key="index">
                <button
                    v-if="item.typeOfButton"
                    class="
                        flex
                        w-full
                        cursor-pointer
                        px-4
                        py-2
                        text-sm
                        leading-5
                        text-gray-700
                        hover:bg-gray-200 hover:text-gray-900
                        focus:outline-none focus:bg-gray-100 focus:text-gray-900
                        whitespace-no-wrap
                    "
                    :title="item.title"
                    @click="$emit('fromItem', item.action, items)"
                >
                    <component :is="item.icon" class="mr-2"></component>

                    {{ item.name }}
                </button>
                <a
                    :href="item.url"
                    v-else
                    class="
                        flex
                        cursor-pointer
                        px-4
                        py-2
                        text-sm
                        leading-5
                        text-gray-700
                        hover:bg-gray-200 hover:text-gray-900
                        focus:outline-none focus:bg-gray-100 focus:text-gray-900
                        whitespace-no-wrap
                    "
                    :title="item.title"
                    @click="$emit('fromItem', item.action, items)"
                >
                    <component :is="item.icon" class="mr-2"></component>

                    {{ item.name }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import iconOrderItem from "./dropDownIcons/orderItemIcon.vue";
import iconPublished from "./dropDownIcons/publishedIcon.vue";
import iconCreate from "./dropDownIcons/createIcon.vue";
import iconShow from "./dropDownIcons/showIcon.vue";
import iconEdit from "./dropDownIcons/editIcon.vue";
import iconDelete from "./dropDownIcons/deleteIcon.vue";

import { createdMixin } from "../../mixins/createdMixin";

export default {
    props: ["items"],
    components: { iconEdit, iconDelete, iconShow, iconCreate, iconPublished, iconOrderItem },
    mixins: [createdMixin],
    data() {
        return {
            isOpen: false,
            dropdown: false,
        };
    },

    computed: {
        addBackground: function () {
            return this.isOpen ? "bg-gray-400" : "";
        },
    }
};
</script>
