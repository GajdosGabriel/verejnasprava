<template>
    <div class="card">
        <div class="card-header">
            <strong style="font-size: 120%;"> {{ createOrEditTitle }} {{ order.order_number }}</strong>
            <a href="#" class="btn btn-default pull-right">Zrušiť</a>
        </div>


        <div class="col-md-12">
            <div class="row">
                <!--Left site-->
                <div class="col-md-6" style="border: solid 1px #9999ab; background: silver">
                    <div class="row">
                        <!--A1-->
                        <div class="col-md-6">
                            <div>Objednávateľ:</div>
                            <div class="pull-left">
                                <strong style="font-size: 130%">{{ subject.name }}</strong> <br>
                                {{ subject.street }} <br>
                                <strong>{{ subject.psc }}  {{ subject.city }}</strong> <br>
                                Ičo: {{ subject.ico }}
                            </div>
                        </div>
                        <!--A2-->
                        <div class="col-md-6">
                            <div class="form-group input-group-sm">
                                <label>Úhrada:</label>
                                <select name="payment" class="form-control" required >
                                    <option selected value="Bankový prevod">Bankový prevod</option>
                                    <option value="Hotovosť">Hotovosť</option>
                                    <option value="Dobierka">Dobierka</option>
                                </select>
                            </div>

                            <div class="form-group input-group-sm">
                                <label>Poznámka</label>
                                <input type="text" name="notes" class="form-control input-sm " placeholder="Poznámka">
                            </div>
                    </div>
                </div>
            </div>
                <!--Right site-->
                <div class="col-md-6">
                    <div class="input-group mt-3 mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Firma</label>
                        </div>
                        <select name="contact_id" @change="changeContact($event)" class="form-control" required id="exampleSelect2">
                            <option value="" selected disabled >Vybrať dodávateľa</option>
                            <option :value="contact.id" v-for="contact in subject.contacts">
                                {{ contact.name }}
                            </option>
                        </select>
                    </div>
                    Dodávateľ:
                    <strong>{{ selectedContact }}</strong><br>
                    <!--{{ selected.street }}<br>-->
                    <!--{{ selected.psc }} {{ selected.city }}<br>-->
                    <!--Ico: {{ selected.ico }} Dic: {{ selected.dic }}<br>-->
                </div>
            </div>
        </div>

   </div>
</template>

<script>
    import moment from 'moment';
    import swal from 'sweetalert2';
    import multiselect from 'vue-multiselect';

    export default {
        props: ['subject'],
        components: { swal, multiselect },
        data: function() {
            return {
                order: this.subject,
                className: { danger: "text-danger", primary: "text-primary" },
//                send: this.orders.order_send
                selectedContact: null
            }
        },

        methods: {
            changeContact: function(event) {
                    this.selectedContact = event.target.options[event.target.options.selectedIndex].text
                },

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
           createOrEditTitle(){
               if (this.order.amounto > 0) {
                   return 'Upraviť objednávku';
               }
               return 'Nová objednávka';
           },
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
