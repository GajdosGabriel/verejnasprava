<template>
    <div>
        <a @click="isOpen = !isOpen" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" href="#">aaa</a>
        <a v-if="isOpen" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4" href="#">okno</a>



    </div>
</template>

<script>
    export default {
        data() {
            return {
                isOpen: false
            }
        },
        created: function() {
            let self = this;

            window.addEventListener('click', function(e){
                // close dropdown when clicked outside
                if (!self.$el.contains(e.target)){
                    self.isOpen = false
                }
            })
        },

    }
</script>
