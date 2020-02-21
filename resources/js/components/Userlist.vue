<template>
    <div>
        <button  class="btn btn-default" @click="isOpen = !isOpen">Zobraziť používateľov</button>

                <div class="animated" style="height: 100%; margin-bottom: 20px" v-show="isOpen" transition="expand">
                <slot></slot>
                 </div>

    </div>

</template>

<script>
    export default {
        data: function() {
            return {
                isOpen: false
            }
        }

    }

</script>

<style>
    /* always present */
    .expand-transition {
        transition: all .3s ease;
        height: 30px;
        padding: 10px;
        background-color: #eee;
        overflow: hidden;
    }
    /* .expand-enter defines the starting state for entering */
    /* .expand-leave defines the ending state for leaving */
    .expand-enter, .expand-leave {
        height: 0;
        padding: 0 10px;
        opacity: 0;
    }
</style>
