<template>
    <div>
        <a
            v-for="item in items"
            :key="item.index"
            class="block flex px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900 whitespace-no-wrap"
            title="Upraviť položku"
            :href="item.url"
        >
            <component :is="item.icon" class="mr-2"></component>

            {{ item.name }}
        </a>
    </div>
</template>

<script>
import iconEdit from "./itemIcons/editIcon.vue";
import iconDelete from "./itemIcons/deleteIcon.vue";

export default {
    components: { iconEdit, iconDelete },
    props: ["items"],
    data() {
        return {};
    },
    computed: {},
    created: function() {}
};
</script>
