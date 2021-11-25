<template>
    <div class="fixed z-10 inset-0 overflow-y-auto" v-if="showModal">
        <div
            class="
                flex
                items-end
                justify-center
                min-h-screen
                pt-4
                px-4
                pb-20
                text-center
                sm:block sm:p-0
            "
        >
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span
                class="hidden sm:inline-block sm:align-middle sm:h-screen"
            ></span
            >&#8203;

            <slot></slot>


        </div>
    </div>
</template>

<script>
import { mapState } from "vuex";

export default {

    computed: mapState({
        showModal: (state) => state.modals.showModal,
    }),
};
</script>
