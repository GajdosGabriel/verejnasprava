<template>
    <div>
        <orderHeader :subject="order" :contacts="contacts"></orderHeader>
        <orderBody></orderBody>

    </div>
</template>

<script>
    import orderHeader from './Order1-header.vue';
    import orderBody from './Order1-body.vue';
    export default {
        props:['order', 'contacts'],
        components: { orderHeader, orderBody},
        data:function() {
            return {

            }
        }
    }
</script>

<style>

</style>