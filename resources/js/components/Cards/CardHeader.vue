<template>
    <header
        class="flex justify-between items-center px-2 py-2  cursor-pointer bg-gray-200 hover:bg-gray-300"
    >
        <div class="flex items-center justify-center">
        <universal-icon :iconSVG="icon"></universal-icon>
            <h3 class="font-semibold cursor-pointer" v-text="title"></h3>
        </div>

    </header>
</template>

<script>
import universalIcon from "../../components/icons/universalIcon.vue";
export default {
    props: ["icon", "title"],
    components: { universalIcon }
};
</script>
