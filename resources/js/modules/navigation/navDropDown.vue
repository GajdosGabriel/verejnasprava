<template>
    <div class="relative w-8 h-8 hover:bg-gray-200 flex justify-center content-center rounded-full transition duration-500 ease-in-out">
        <button @click="isOpen =! isOpen" class="focus:outline-none">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20">
                <path
                    d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
            </svg>


            <div v-if="isOpen"
                 class="absolute right-0 z-10 flex flex-col w-auto py-1 text-sm bg-white border-2 border-gray-300 rounded shadow-md">
                <slot></slot>


<!--                <div class="py-1"></div>-->

            </div>
        </button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isOpen: false,
                dropdown: false,
            }
        },
        computed: {
            signedIn: function () {
                return window.App.signedIn;
            },

            fullName: function () {
                return window.App.user.first_name + ' ' + window.App.user.last_name;
            }
        },
        created: function () {
            let self = this;

            window.addEventListener('click', function (e) {
                // close dropdown when clicked outside
                if (!self.$el.contains(e.target)) {
                    self.isOpen = false
                    self.dropdown = false
                }
            })
        },

    }
</script>


