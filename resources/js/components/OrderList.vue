<template>
        <tr class="table tbody">
            <td><a :href="'/' + orders.user.slug + '/ordershow/' + orders.id">{{ orders.order_number }} / {{ year }}</a></td>
            <td v-text="orders.customer.company"></td>
            <td v-text="orders.customer.city"></td>
            <td v-text="orders.orderPublished"></td>
            <td v-text="orders.payment"></td>
            <td v-text="orders.worker.firstName"></td>
            <td><strong>{{ orders.grandTotal }},- </strong></td>
            <transition name="bounce">
                <td v-show="send" @click="changeStatus(orders.id)" class="text-primary" title="Stav objednávky" style="cursor: pointer" >Odoslaná</td>
            </transition>
            <td v-show="!send" @click="changeStatus(orders.id)" class="text-danger" title="Stav objednávky" style="cursor: pointer" >Neodoslaná</td>
            <td>
                <a class="faicons" :href="'/' + orders.user.slug + '/ordershow/' + orders.id + '/pdf'" target="_blank"><i class="fa fa-print" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vytlačiť"></i></a>
                <a class="faicons" :href="'/' + orders.user.slug + '/orderedit/' + orders.id"><i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Upraviť položku"></i></a>
                <i @click="destroyOrder(orders.id)" style="font-size: 118%; color: #b40000; cursor: pointer" class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Vymazať položku"></i>

            </td>
        </tr>
</template>

<script>
    import moment from 'moment';
    import swal from 'sweetalert2';

    export default {
        props: ['orders'],
        components: { swal },
        data: function() {
            return {
                className: { danger: "text-danger", primary: "text-primary" },
                send: this.orders.order_send

            }
        },

        methods: {

            changeStatus: function(id) {

                swal({
                    title: 'Odoslať objednávku?',
                    text: "Odoslanie na email dodávateľa!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Neodoslať',
                    confirmButtonText: 'Áno, odoslať!'
                }).then(function () {

                    this.send = !this.send;
                axios.patch('/orderSendStatus/' + id);
                }.bind(this));


            },

            destroyOrder: function(id) {

                swal({
                    title: 'Skutočne vymazať?',
                    text: "Vymazanie bude definitívne a nevratné!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Nemazať',
                    confirmButtonText: 'Áno, vymazať!'
                }).then(function () {

                    axios.delete('/deleteOrder/' + id);
                    $(this.$el).fadeOut(300);
                }.bind(this));

            }

        },

        computed: {
            year: function() {
        return moment(this.orders.created_at).format('Y');
            }

        }

    }
</script>
<style>
    .bounce-enter-active {
        animation: bounce-in .5s;
    }
    .bounce-leave-active {
        animation: bounce-in .5s reverse;
    }
    @keyframes bounce-in {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.3);
        }
        100% {
            transform: scale(1);
        }
    }
</style>