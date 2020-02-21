<template>
    <div>
    <table class="table">
        <thead class="bg-success">
        <tr>
            <th>Por.</th>
            <th>Dodávateľ</th>
            <th>Mesto</th>
            <th>Vystavená</th>
            <th>Platba</th>
            <th>Podpísal</th>
            <th>Suma</th>
            <th>Status</th>
            <th>Panel</th>
        </tr>
        </thead>

        <tbody v-for="(order, index) in reverse" class="thead-inverse">
        <orderlist :orders="order" ></orderlist>
        </tbody>

    </table>
    </div>
</template>

<script>
    import moment from 'moment';
    import orderlist from './OrderList.vue';
    export default {
        props: ['orders'],
        components: { orderlist },
        data: function() {
            return {
                order: this.orders




            }
        },

        methods: {

        },
        computed: {
            reverse: function() {
                return _.reverse(this.orders);
//                return  this.ord.slice().reverse();
            }



        }

    }
</script>
<style>

</style>