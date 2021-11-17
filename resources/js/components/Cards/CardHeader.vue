<template>
    <header
        class="flex justify-between items-center px-2 py-2  cursor-pointer bg-gray-200 "
        :class="[isOpen ? 'bg-gray-600 text-white' : 'hover:bg-gray-200']"
    >
        <div class="flex">
            <comment :is="icon" />
            <h3 class="font-semibold cursor-pointer ml-2" v-text="title"></h3>
            <h3
                v-if="title2"
                class="text-red-400 font-semibold cursor-pointer ml-2"
            >
                ({{ title2 }})
            </h3>
        </div>
        <component :is="rightIcon" />
    </header>
</template>

<script>
import config from "../icons/config.vue";
import tag from "../icons/tag.vue";
import mail from "../icons/mail.vue";
import openRightIcon from "../icons/openRightIcon.vue";
import closeRightIcon from "../icons/closeRightIcon.vue";
import Comment from "../../tasks/Comments/Comment.vue";
export default {
    props: {
        icon: {
            type: String
        },
        title: {
            type: String
        },
        title2: {
            default: null
        },
        isOpen: {
            type: Boolean,
            default: null
        }
    },
    components: { openRightIcon, closeRightIcon, mail, tag, Comment, config },
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
