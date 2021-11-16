<template>
    <header
        class="flex justify-between items-center px-2 py-2  cursor-pointer bg-gray-200 "
        :class="[isOpen ? 'bg-gray-600 text-white' : 'hover:bg-gray-200']"
    >
        <div class="flex items-center justify-center">
            <comment :is="icon" />
            <h3 class="font-semibold cursor-pointer" v-text="title"></h3>
        </div>
        <component :is="rightIcon" />
    </header>
</template>

<script>
import tag from "../icons/tag.vue";
import mail from "../icons/mail.vue";
import openRightIcon from "../icons/openRightIcon.vue";
import closeRightIcon from "../icons/closeRightIcon.vue";
import Comment from "../../tasks/Comments/Comment.vue";
export default {
    props: ["icon", "title", "isOpen"],
    components: { openRightIcon, closeRightIcon, mail, tag, Comment },
    computed: {
        rightIcon() {
            if (this.isOpen) {
                return openRightIcon;
            }
            return closeRightIcon;
        }
    }
};
</script>
