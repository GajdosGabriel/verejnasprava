<template>
    <div>
    <table class="table">
        <thead class="bg-success">
        <tr>
            <th>Vystavená</th>
            <th>Dodávateľ</th>
            <th>Platba</th>
            <th>Vystavil</th>
            <th>Suma</th>
            <th>Status</th>
            <th>Panel</th>
        </tr>
        </thead>

        <tbody v-for="(order, index) in reverse" class="thead-inverse">
        <orderItem :row="order" ></orderItem>
        </tbody>

    </table>
    </div>
</template>

<script>
    import moment from 'moment';
    import orderItem from './Order-index-item.vue';
    export default {
        props: ['orders'],
        components: { orderItem },
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