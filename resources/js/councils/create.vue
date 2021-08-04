<template>

</template>

<script>
    export default {
        data: function () {
            return {
                show: false,
                form: this.user
            }
        },
        methods: {
            toggle: function () {
                this.show = !this.show
            },

            save: function () {
                axios.patch('/user/'+ this.form.id + '/', this.form);
            }
        }
    }
</script>
