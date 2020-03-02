<template>
    <div>
        <div class="card">
            <table class="table">
                <thead style="background: #464646; color:white">
                <tr>
                    <td>Por.</td>
                    <td class="w-50">Položka</td>
                    <td>Počet</td>
                    <td>Cena/ks</td>
                    <td>Cena/Euro</td>
                    <td>Panel</td>
                </tr>
                </thead>

                <!-- Riadky objednávky -->
                <tbody  style="background: rgba(107, 99, 100, 0.23)">
                    <tr v-for="(item, index) in items">
                        <td>{{ index +1 }}</td>
                        <td><textarea style="width: 100%" name="name[]" v-model="item.name" rows="1" required>Objednávame </textarea></td>
                        <td><input placeholder="počet" type="number" required name="quantity[]"  v-model="item.quantity" ></td>
                        <td><input placeholder="cena" type="number" v-on:keyup.enter="addItem" step="0.01" required name="price[]" v-model="item.price"></td>
                        <td style="width: 10%">{{ item.quantity * item.price | zaokruhlenie }},-</td>
                        <td><a title="Zmazať položku" class="btn btn-default btn-xs pull-right" @click="removeItem(index)">X</a></td>
                    </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-n3">
                <a @click="addItem" class="btn btn-secondary btn-sm">Nový riadok</a>
            </div>
        </div>

        <!-- Total -->
        <input type="hidden" name="amount" :value="totalPrice">

        <table class="table" style="margin-bottom: 55px">
            <thead>
            <tr>
                <td colspan="2">S DPH 20%: <strong>{{ totalPrice | vat20 }}</strong> || S DPH 10%: <strong>{{ totalPrice | vat10 }}</strong></td>

                <td><strong>Počet {{ totalQuantity }}</strong></td>
                <td class="pull-right"><strong style="font-size: 115%">Celkom: {{ totalPrice }},- Eu</strong></td>

                <td>
                    <div class=" btn-group pull-right">
                        <button type="submit" name="order_send" value="0" class="btn btn-primary">Uložiť</button>
                        <button type="submit" name="order_send" value="1"  class="btn btn-info">Uložiť a odoslať</button>
                    </div>
                </td>
            </tr>
            </thead>
        </table>
    </div>

</template>
<script>
    export default {
        data: function() {
            return {
                items: [{name: "Objednávame ", quantity: "1", price: "" }]
            }
        },
              methods: {
                addItem: function(){
                    this.items.push( {name: "", quantity: "1", price: "0"});
                },

                removeItem: function(item){
                    if(this.items.length > 1) {
                        this.$delete(this.items, item);
                    }
                }
            },
            computed: {
                totalPrice: function () {
                    var total = 0;
                    this.items.forEach(function (item) {
                        total += item.price * item.quantity;
                    });
                    return total.toFixed(2);
                },

                totalQuantity: function() {
                    var quantity = 0;
                    this.items.forEach(function(item) {
                        quantity += +item.quantity;
                    });
                    return quantity;
                }


        },
         filters: {
             vat20: function(value) {
        return (value*1.20).toFixed(2);
            },

             vat10: function(value) {
                 return (value*1.1).toFixed(2);
             },

             zaokruhlenie: function(value) {
                 return (value).toFixed(2);
             }
         }


    }

</script>
