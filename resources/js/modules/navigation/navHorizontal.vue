<template>

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
