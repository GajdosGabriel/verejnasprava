<template>
    <div class="relative inline-block text-left" v-if="$auth.isAdmin()">
        <div>
            <span class="rounded-md shadow-sm">
                <button @click="isOpen =! isOpen" class="focus:outline-none">
               <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                                    <path
                                        d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                </svg>
                    <!--             Heroicon name: chevron-down -->
                    <!--        <svg class="-mr-1 ml-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">-->
                    <!--          <path fill-rule="evenodd"-->
                    <!--                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
                    <!--                clip-rule="evenodd"/>-->
                    <!--        </svg>-->
              </button>
            </span>
        </div>


        <div v-if="isOpen" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg z-10">
            <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                 aria-labelledby="options-menu">
                <slot></slot>
            </div>
        </div>
    </div>


    <!--    <div class="relative w-8 h-8 hover:bg-gray-200 flex justify-center content-center rounded-full transition duration-500 ease-in-out">-->
    <!--        <button @click="isOpen =! isOpen" class="focus:outline-none">-->
    <!--            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"-->
    <!--                 viewBox="0 0 20 20">-->
    <!--                <path-->
    <!--                    d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>-->
    <!--            </svg>-->


    <!--            <div v-if="isOpen"-->
    <!--                 class="absolute right-0 z-10 flex flex-col w-auto py-1 text-sm bg-white border-2 border-gray-300 rounded shadow-md">-->
    <!--                <slot></slot>-->


    <!--&lt;!&ndash;                <div class="py-1"></div>&ndash;&gt;-->

    <!--            </div>-->
    <!--        </button>-->
    <!--    </div>-->
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


