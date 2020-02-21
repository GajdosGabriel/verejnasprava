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
                    <td>Spolu</td>
                    <td><a @click="addItem" class="btn btn-primary btn-sm pull-right">Riadok</a></td>
                </tr>
                </thead>

                <!-- Riadky objednávky -->
                <tbody  style="background: rgba(220, 75, 78, 0.23)">
                <tr v-for="(item, index) in items">
                    <td>{{ index +1 }}</td>
                    <td><textarea style="width: 100%" name="itemName[]" rows="1" required>Objednávame </textarea></td>
                    <td><input placeholder="počet" type="number" required name="quantity[]"  v-model="item.quantity" ></td>
                    <td><input placeholder="cena" type="number" step="0.01" required name="price[]" v-model="item.price"></td>
                    <td style="width: 10%">{{ item.quantity * item.price | zaokruhlenie }},- Euro</td>
                    <td><a title="Zmazať položku" class="btn btn-default btn-xs pull-right" @click="removeItem(index)">X</a></td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Total -->
        <input type="hidden" name="totalPrice" :value="totalPrice">

        <table class="table" style="margin-bottom: 55px">
            <thead>
            <tr>
                <td><a @click="addItem" class="btn btn-primary btn-sm pull-left">Nový riadok</a></td>
                <td colspan="2">S DPH 20%: <strong>{{ totalPrice | vat20 }}</strong> || S DPH 10%: <strong>{{ totalPrice | vat10 }}</strong></td>

                <td><strong>Počet {{ totalQuantity }}</strong></td>
                <td class="pull-right"><strong style="font-size: 115%">Celkom: {{ totalPrice }},- Eu</strong></td>
                <td>
                    <div class=" btn-group pull-right">
                        <button type="submit" name="order_send" value="0" class="btn btn-primary btn-sm">Uložiť</button>
                        <button type="submit" name="order_send" value="1"  class="btn btn-info btn-sm">Uložiť a odoslať</button>
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
                items: [
                    {name: "", quantity: "1", price: "" }
                ]

            }
        },
              methods: {
                addItem: function(){
                    this.items.push( {name: "ccccccccc", quantity: "1", price: "0"});
                },

                removeItem: function(item){
                    this.items.splice(item,1);
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





<!--<template>-->
    <!--<div>-->
        <!--<div class="panel panel-default">-->
            <!--<div class="panel-heading"><strong>Riadky</strong><button @click="addRow" class="btn btn-primary btn-sm pull-right">Row</button></div>-->
            <!--<table class="table">-->
                <!--<thead>-->
                <!--<tr>-->
                    <!--<td>Por.</td>-->
                    <!--<td>položka</td>-->
                    <!--<td>Počet</td>-->
                    <!--<td>Cena/ks</td>-->
                    <!--<td>Spolu</td>-->
                    <!--<td></td>-->
                <!--</tr>-->
                <!--</thead>-->
                <!--<tbody  style="background: rgba(220, 75, 78, 0.23)">-->
                <!--<tr v-for="(row, index) in rows">-->
                    <!--<td>{{ index +1 }}</td>-->
                    <!--<td><textarea name="itemName[]" rows="1" required>Objednávame </textarea></td>-->
                    <!--<td><input placeholder="počet" type="number" required name="quantity[]"   ></td>-->
                    <!--<td><input placeholder="cena" type="number" step="0.01" required name="price[]" ></td>-->
                    <!--<td>{{ quantity * price }},- Euro  </td>-->
                    <!--<td>Počet: </td>-->
                    <!--<td><button  class="btn btn-default btn-xs pull-right" @click="removeItem(index)">X</button></td>-->
                <!--</tr>-->
                <!--</tbody>-->
            <!--</table>-->



        <!--</div>-->

        <!--<table class="table" style="margin-bottom: 55px">-->
            <!--<thead>-->
            <!--<tr>-->
                <!--<td><button @click="addRow" class="btn btn-primary btn-sm pull-left">Row</button></td>-->
                <!--<td class="pull-right">Spolu: </td>-->
                <!--<td>-->
                    <!--<div class=" btn-group pull-right">-->
                        <!--<button type="submit" name="order_send" value="0" class="btn btn-primary btn-sm">Uložiť</button>-->
                        <!--<button type="submit" name="order_send" value="1"  class="btn btn-info btn-sm">Uložiť a odoslať</button>-->
                        <!--&lt;!&ndash;<a href="{{ url()->previous() }}" class="btn btn-default">Zrušiť</a>&ndash;&gt;-->
                    <!--</div>-->
                <!--</td>-->
            <!--</tr>-->
            <!--</thead>-->
        <!--</table>-->
    <!--</div>-->

<!--</template>-->
<!--<script>-->
    <!--export default {-->
        <!--data: function() {-->
            <!--return {-->
                <!--itemName: 'Objednávam ',-->
                <!--quantity: '',-->
                <!--price: '',-->
                <!--updating: true,-->
                <!--rows: []-->

            <!--}-->
        <!--},-->

        <!--mounted: function () {-->
            <!--var elem = document.createElement('tr');-->
            <!--this.rows.push(elem);-->
        <!--},-->

        <!--methods: {-->

            <!--addRow: function() {-->
                <!--var elem = document.createElement('tr');-->
                <!--this.rows.push(elem);-->
            <!--},-->


            <!--removeItem: function(index) {-->
                <!--this.rows.splice(index, 1);-->
<!--//                $(this.$el).fadeOut(300);-->

            <!--}-->

        <!--},-->
        <!--computed: {-->



        <!--}-->
    <!--}-->

<!--</script>-->

