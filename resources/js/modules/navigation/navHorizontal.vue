<template>

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
            signedIn: function() {
                return window.App.signedIn;
            },

            fullName: function () {
                return window.App.user.first_name + ' ' + window.App.user.last_name;
            }
        },
        created: function() {
            let self = this;

            window.addEventListener('click', function(e){
                // close dropdown when clicked outside
                if (!self.$el.contains(e.target)){
                    self.isOpen = false
                    self.dropdown = false
                }
            })
        },

    }
</script>


