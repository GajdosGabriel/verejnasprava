<template>
    <form  @submit.prevent enctype="multipart/form-data">
        <orderHeader :subject="order" @customerDetailForm="handleCustomerForm"></orderHeader>
        <orderBody :attribute="order"></orderBody>
    </form>
</template>

<script>
    import orderHeader from './Order-header.vue';
    import orderBody from './Order-body.vue';
    export default {
        props:['order'],
        components: { orderHeader, orderBody },
        data:function() {
            return {
                orderHeader: null
            }
        },

        methods: {
            handleCustomerForm(customer) {
                console.log('headerForm',customer);
                this.orderHeader = customer;
            }
        }
    }
</script>

<style>

</style>
